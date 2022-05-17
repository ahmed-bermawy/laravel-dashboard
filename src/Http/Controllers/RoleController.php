<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends DashboardController
{

    public function __construct()
    {
        parent::__construct('Admin');
        $this->tableModel = new Role();
        $this->inputsValidation = [
            'name' => 'required|min:3|unique:roles'
        ];
        $this->inputsEditValidation = [
            'name' => 'required|min:3'
        ];
        $permissions = Permission::all(['id', 'name']);
        $columns = [
            [
                'columnName' => 'name',
                'title' => 'Name',
                'type' => 'text',
                'message' => 'Required',
            ]
        ];
        foreach ($permissions as $permission) {
            $columns[] = [
                'columnName' => 'permissions[]',
                'title' => $permission->name,
                'value' => $permission->id,
                'type' => 'checkbox',
            ];
        }
        $this->inputsValidationMessages = [];

        $this->tableColumns = $columns;
    }

    public function index(Request $request)
    {
        $this->authorize($this->controllerName . '-view');

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        //Search on database
        $keyword = $request->input('search');
        $columns = $request->input('columns');
        $order = $request->input('order');
        if ($order) {
            $display['data'] = $this->tableModel->orderBy($order, $request->input('dir'))->get();
        } elseif ($columns) {
            $key = array_key_first($columns);
            $value = $columns[$key];
            $display['data'] = $this->tableModel->where($key, "LIKE", "%$value%")
                ->orderBy($this->tablePk, 'desc')->get();
        } elseif ($keyword) {
            $display['data'] = $this->tableModel->where("name", "LIKE", "%$keyword%")->orderBy($this->tablePk, 'desc')->get();
        } else {
            $display['data'] = $this->tableModel->orderBy($this->tablePk, 'desc')->paginate(20);
            $display['totalResult'] = $this->tableModel->count();
        }

        return view('dashboard.index')->with($display);
    }

    public function create()
    {
        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Create';
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['selected_value'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        return view('dashboard.roles.create')->with($display);

    }

    public function store(Request $request)
    {
        $this->authorize('role-create');

        $this->validate($request, $this->inputsValidation, $this->inputsValidationMessages);
        $created = $this->tableModel::create($request->only(['name']));
        $permissions = $created->permissions()->sync($request->permissions);
        if (!$created) {
            return Redirect::back()->withErrors(['Fail']);
        }

        return Redirect::to($this->path);
    }

    public function edit($id)
    {
        $this->authorize('role-update');

        $getData = $this->tableModel::with('permissions')->find($id);
        $value = $getData->permissions ?? '';

        $display['select_from_another_table'] = true;
        $display['selected_value'] = ['input_name' => 'permissions', 'input_value' => $value ?? ''];
        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Update';
        $display['tablePk'] = $this->tablePk;
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        $display['data'] = $this->tableModel->findOrFail($id);
        return view('dashboard.roles.edit')->with($display);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('role-update');

        $this->validate($request, $this->inputsEditValidation, $this->inputsValidationMessages);
        $role = $this->tableModel::find($id);
        $update = $role->update($request->all());
        if (!$update) {
            return Redirect::to($this->path)->with('message', 'Email Already Exist Please Try Another Email');
        }
        $role->permissions()->sync($request->permissions);

        return Redirect::to($this->path);
    }

    public function destroy($id)
    {
        $this->authorize('role-delete');

        $data = $this->tableModel->find($id);
        if ($data) {
            if ($data->image) {
                File::delete(public_path($this->imagePath) . $data->image);
            }
            $data->delete();

            return json_encode(['msg' => 'Row Deleted', 'status' => 'success']);
        } else {
            return json_encode(['msg' => 'Failed Deleting Row', 'status' => 'failed']);
        }
    }
}
