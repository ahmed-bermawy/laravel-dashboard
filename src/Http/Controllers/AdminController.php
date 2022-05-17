<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class AdminController extends DashboardController
{

    public function __construct()
    {
        parent::__construct('Admin');

        $this->inputsValidation = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:admins',
            'password' => 'required',
            'roles' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
        $this->inputsEditValidation = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'roles' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
        $this->inputsValidationMessages = [
            'image.mimes' => 'Allowed Extensions:jpeg,png,jpg',
            'image.max' => 'Max Size 2MB'
        ];

        $this->tableColumns = [
            [
                'columnName' => 'name',
                'title' => 'Name',
                'type' => 'text',
                'message' => 'Required',
            ],
            [
                'columnName' => 'email',
                'title' => 'Email',
                'type' => 'text',
                'message' => 'Required',
            ],
            [
                'columnName' => 'password',
                'title' => 'Admin Password',
                'type' => 'password',
                'message' => 'Required',
            ],
            [
                'columnName' => 'roles',
                'title' => 'Roles',
                'type' => 'select',
                'message' => 'Required',
                'arrayOfData' => Role::all(['id as key', "name as value"]),
            ],
            [
                'columnName' => 'image',
                'title' => 'Profile Image',
                'type' => 'image',
                'filePath' => $this->imagePath,
                'message' => 'Allowed Extinsion:jpeg,png,jpg,gif - Max Size 2MB',
            ],
            [
                'columnName' => 'id',
                'title' => 'Change Password',
                'type' => 'popup',
                'message' => 'Change Password',
                'value' => 'email',
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
        $display['tableHeader'] = $this->tableColumns;//change to inputs
        $display['message'] = session('message');
        //Search on database
        $keyword = $request->input('search');
        $columns = $request->input('columns');
        $order = $request->input('order');
        if ($order) {
            $display['data'] = $this->tableModel->orderBy($order, $request->input('dir'))->get();
        } elseif ($columns) {
            $display['data'] = $this->tableModel->SearchByKeywordAndColumn($columns)
                ->orderBy($this->tablePk, 'desc')->get();
        } elseif ($keyword) {
            $display['data'] = $this->tableModel->SearchByKeyword($keyword)->orderBy($this->tablePk, 'desc')->get();
        } else {
            $display['data'] = $this->tableModel->orderBy($this->tablePk, 'desc')->paginate(20);
            $display['totalResult'] = $this->tableModel->count();
        }

        return view('dashboard.index')->with($display);
    }


    public function store(Request $request)
    {
        $this->authorize('admin-create');
        $this->validate($request, $this->inputsValidation, $this->inputsValidationMessages);

        $created = $this->tableModel::create($request->all());
        if (!$created) {
            return Redirect::back()->withErrors(['Email Already Exist Please Try Another Email']);
        }
        $role = $created->roles()->sync($request->roles);

        $common = new CommonController();
        $common->uploadImage($request, $this->tableName, 'image', $created->id, $this->imagePath);

        return Redirect::to($this->path);
    }

    public function edit($id)
    {
        $this->authorize('admin-update');
        $getData = $this->tableModel::find($id);
        $value = $getData->roles[0]->id ?? '';
        $display['selectSelectedValue'] = $value; //select selected values

//        $display['selected_value'] = ['input_name' => 'roles', 'input_value' => $value ?? ''];
        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Update';
        $display['tablePk'] = $this->tablePk;
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        $display['data'] = $getData;
        return view('dashboard.edit')->with($display);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('admin-update');
        $this->validate($request, $this->inputsEditValidation, $this->inputsValidationMessages);

        $user = $this->tableModel::find($id);
        $update = ($request->input('password') === null) ?
            $user->update($request->except('password')) :
            $user->update($request->all());
        if (!$update) {
            return Redirect::to($this->path)->with('message', 'Email Already Exist Please Try Another Email');
        }
        $user->roles()->sync($request->roles);

        $common = new CommonController();
        $common->updateImage($request, $this->tableName, 'image', $id, $this->imagePath);

        return Redirect::to($this->path);
    }

    public function changePassword(Request $request)
    {
        $this->authorize('admin-update');
        $id = $request['id'];
        $password = $request['password'];

        $isFound = $this->tableModel->where('id', $id)->first();
        if ($isFound) {
            $new_password = Hash::make($password);
            $update = $this->tableModel->where('id', $id)->update(['password' => $new_password]);
            if ($update) {
                return json_encode(['msg' => 'Password Changed Successfully', 'status' => 'success']);
            } else {
                return json_encode(['msg' => 'Failed Changing Password', 'status' => 'failed']);
            }
        } else {
            return json_encode(['msg' => 'Failed Changing Password', 'status' => 'failed']);
        }
    }

    public function destroy($id)
    {
        $this->authorize('admin-delete');
        $data = $this->tableModel->find($id);
        if ($data) {
            if ($data->image) {
                \File::delete(public_path($this->imagePath) . $data->image);
            }
            $data->delete();

            return json_encode(['msg' => 'Row Deleted', 'status' => 'success']);
        } else {
            return json_encode(['msg' => 'Failed Deleting Row', 'status' => 'failed']);
        }
    }
}
