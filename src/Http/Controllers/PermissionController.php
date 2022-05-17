<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends DashboardController
{

    public function __construct()
    {
        parent::__construct('Admin');
        $this->tableModel = new Permission();
        $this->inputsValidation = [
            'name' => 'required|min:3|unique:permissions'
        ];
        $this->inputsEditValidation = [
            'name' => 'required|min:3|unique:permissions'
        ];
        $this->inputsValidationMessages = [];

        $this->tableColumns = [
            [
                'columnName' => 'name',
                'title' => 'Name',
                'type' => 'text',
                'message' => 'Required | write controller name in singular & lower case',
            ],
        ];
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
        $order = $request->input('order');
        $columns = $request->input('columns');
//        dd(array_key_first($columns));
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
            $display['data'] = $this->tableModel->orderBy('order_id', 'asc')->paginate($this->tableModel->count());
            $display['totalResult'] = $this->tableModel->count();
        }

        return view('dashboard.index')->with($display);
    }

    public function create()
    {
        $this->authorize($this->controllerName . '-create');

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Create';
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        return view('dashboard.create')->with($display);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $this->authorize($this->controllerName . '-create');

        $this->validate($request, $this->inputsValidation, $this->inputsValidationMessages);
        $permissions = ['create', 'view', 'update', 'delete'];
        $created = 0;
        foreach ($permissions as $permission) {
            try {
                $created = $this->tableModel::create(['name' => $request->input('name') . '-' . $permission]);
            } catch (\Exception $e) {
                $created = 0;
            }
        }
//        $created = $this->tableModel::create($request->input('name'));
//        $role = $created->roles()->sync($request->roles);
        if (!$created) {
            return Redirect::back()->withErrors(['Controller Already Exist Please Try Another ']);
        }

        return Redirect::to($this->path);
    }

    public function edit($id)
    {
        $this->authorize($this->controllerName . '-update');

        $getData = $this->tableModel::with('roles')->find($id);
        $value = $getData->roles[0]->id ?? '';

        $display['select_from_another_table'] = true;
        $display['selected_value'] = ['input_name' => 'roles', 'input_value' => $value ?? ''];

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Update';
        $display['tablePk'] = $this->tablePk;
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        $display['data'] = $this->tableModel->findOrFail($id);
        return view('dashboard.edit')->with($display);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('permission-update');

        $this->validate($request, $this->inputsEditValidation, $this->inputsValidationMessages);
        $user = $this->tableModel::find($id);
        $update = $user->update($request->all());
        if (!$update) {
            return Redirect::to($this->path)->with('message', 'Permission Already Exist Please Try Another');
        }
        $user->roles()->sync($request->roles);

        return Redirect::to($this->path);
    }

    public function sort(Request $request)
    {
        $this->authorize('permission-update');

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        $display['data'] = $this->tableModel->orderBy('order_id', 'asc')->paginate($this->tableModel->count());

        //Search on database
        return view('dashboard.order')->with($display);
    }

    public function saveOrder(Request $request)
    {
        $this->authorize('permission-update');

        foreach ($request->id as $order_id => $id) {
            Permission::where('id', $id)->update(['order_id' => ++$order_id]);
        }
        return redirect($this->path)->with(['success' => 'Permissions sorted successfully']);
    }

    public function destroy($id)
    {
        $this->authorize('permission-delete');

        $data = $this->tableModel->find($id);
        if ($data) {
            $data->delete();

            return json_encode(['msg' => 'Row Deleted', 'status' => 'success']);
        } else {
            return json_encode(['msg' => 'Failed Deleting Row', 'status' => 'failed']);
        }
    }
}
