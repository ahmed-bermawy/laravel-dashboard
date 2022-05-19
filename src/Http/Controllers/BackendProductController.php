<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Requests;
use App\Models\dashboard\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BackendProductController extends DashboardController
{
    public function __construct()
    {
        parent::__construct('BackendProduct');
//        $this->pageTitle = 'Products';
        $this->inputsValidation = [
            'name' => 'required|min:3',
            'short_description' => 'required|min:10',
            'description' => 'required|min:10',
            'group_id' => 'required',
            'free_delivery' => 'required|boolean',
            'payment' => 'required',
            'release_date' => 'required|date',
            'publish_date' => 'required|date',  //Y-m-d, H:i.
            'password' => 'required|min:6',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'file' => 'mimes:pdf|max:2048'
        ];
        $this->inputsEditValidation = [
            'name' => 'required|min:3',
            'short_description' => 'required|min:10',
            'description' => 'required|min:10',
            'group_id' => 'required',
            'free_delivery' => 'required|boolean',
            'payment' => 'required',
            'release_date' => 'required|date',
            'publish_date' => 'required|date',
            'password' => 'nullable|min:6',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'file' => 'mimes:pdf|max:2048'
        ];
        $this->inputsValidationMessages = [
            'image.mimes' => 'Allowed Extensions:jpeg,png,jpg',
            'image.max' => 'Max Size 2MB',
            'file.mimes' => 'Allowed Extensions:pdf',
            'file.max' => 'Max Size 2MB'
        ];
        $this->tableColumns = [
            [
                'columnName' => 'name',
                'title' => 'Name',
                'type' => 'text',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'short_description',
                'title' => 'Short Description',
                'type' => 'textarea',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'description',
                'title' => 'Description',
                'type' => 'editor',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'image',
                'title' => 'Image',
                'type' => 'image',
                'filePath' => $this->imagePath,
                'message' => 'Allowed Extension:jpeg,png,jpg,gif - Max Size 2MB',
                'canOrder' => true
            ],
            [
                'columnName' => 'file',
                'title' => 'File',
                'type' => 'file',
                'filePath' => $this->imagePath,
                'message' => 'Allowed Extension:pdf- Max Size 2MB',
                'canOrder' => true
            ],
            [
                'columnName' => 'group_id',
                'title' => 'Group Id',
                'type' => 'select',
                'arrayOfData' => [
                    ['key' => 1, 'value' => 'false'],
                    ['key' => 2, 'value' => 'true'],
                ],
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'free_delivery',
                'title' => 'Free Delivery',
                'type' => 'radio',
                'message' => 'Required',
                'arrayOfData' => [
                    ['key' => 'yes', 'value' => '1'],
                    ['key' => 'no', 'value' => '0'],
                ],
                'canSearch' => true,
                'canOrder' => true
            ],
            [ //edit after finish
                'columnName' => 'payment',
                'title' => 'Payments Options',
                'type' => 'checkboxList',
                'fromRelation' => 'payments',
                'arrayOfData' => Payment::all(['id as key', 'name as value']),
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'release_date',
                'title' => 'Release Date',
                'type' => 'date',
                'format' => 'date',
                'message' => 'Required',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'publish_date',
                'title' => 'Publish Date',
                'type' => 'date',
                'message' => 'Required',
                'format' => 'dateTime',
                'canSearch' => true,
                'canOrder' => true
            ],
            [
                'columnName' => 'password',
                'title' => 'Password',
                'type' => 'password',
                'message' => 'Required',
            ],
            [
                'columnName' => 'property_id',
                'title' => 'Property Id',
                'type' => 'hidden',
                'value' => 'asdasdaada',
            ],
        ];
    }

    public function index(Request $request)
    {
        $this->authorize($this->controllerName . '-view');
        $display['path'] = $this->path;
        $display['pageTitle'] = "products";
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        //Search on database
        $keyword = $request->input('search');
        $customSearch = $request->input('customSearch');
        $order = $request->input('order');
        // custom search start
        if ($customSearch) {
            if ($request->only('payment')) {
                $display['data'] = $this->tableModel->SearchByKeywordAndColumn($request->except(['customSearch', 'dir', 'order']), 'payments', $request->only('payment'))
                    ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
            } else {
                $display['data'] = $this->tableModel->SearchByKeywordAndColumn($request->except(['customSearch', 'dir', 'order']))
                    ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
            }
        }         // custom search start
        //search start
        elseif ($keyword) {
            $display['data'] = $this->tableModel->SearchByKeyword($keyword)
                ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
        } //search end
        else {
            $display['data'] = $this->tableModel
                ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
        }
        $display['data']->appends(request()->query()); //to merge query string with pagination url
        return view('dashboard.index')->with($display);
    }


    public function store(Request $request)
    {
        $this->authorize($this->controllerName . '-create');

        $this->validate($request, $this->inputsValidation, $this->inputsValidationMessages);

        $created = $this->tableModel::create($request->except('payment'));
        if (!$created) {

            return Redirect::back()->withErrors(['Email Already Exist Please Try Another Email']);
        }
        $created->payments()->sync($request->payment);
        if (!$request->image && !$request->file) {
            return Redirect::to($this->path);
        }
        $common = new CommonController();
        $common->uploadImage($request, $this->tableName, 'image', $created->id, $this->imagePath);
        $common->uploadFile($request, $this->tableName, 'file', $created->id, $this->imagePath);

        return Redirect::to($this->path);
    }

    public function edit($id)
    {
        $this->authorize($this->controllerName . '-update');
        $getData = $this->tableModel::find($id);
        $display['checkboxListSelectedValue'] = $getData->payments->pluck('id')->toArray(); //checkboxList selected values
        $display['radioSelectedValue'] = $getData->free_delivery; //radio selected values
        $display['selectSelectedValue'] = $getData->group_id; //select selected values
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
        $this->authorize($this->controllerName . '-update');
        $this->validate($request, $this->inputsEditValidation, $this->inputsValidationMessages);

        $product = $this->tableModel::find($id);
        if (!$product) {
            return Redirect::to($this->path)->with('message', 'product not found');
        }
        $product->update($request->except('payment'));
        $product->payments()->sync($request->payment);

        $common = new CommonController();
        $common->updateImage($request, $this->tableName, 'image', $id, $this->imagePath);
        $common->updateFile($request, $this->tableName, 'image', $id, $this->imagePath);

        return Redirect::to($this->path);
    }

    public function destroy($id)
    {
        $this->authorize($this->controllerName . '-delete');
        $data = $this->tableModel->find($id);
        if ($data) {
            if ($data->image) {
                \File::delete(public_path($this->imagePath) . $data->image);
            }
            if ($data->file) {
                \File::delete(public_path($this->imagePath) . $data->file);
            }
            $data->delete();

            return json_encode(['msg' => 'Row Deleted', 'status' => 'success']);
        } else {
            return json_encode(['msg' => 'Failed Deleting Row', 'status' => 'failed']);
        }
    }
}
