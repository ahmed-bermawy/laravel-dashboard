<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    const PRIMARY_KEY = 'id';
    protected $path;
    protected $pageTitle;
    protected $tableName;
    protected $tablePk;
    protected $imagePath;
    protected $tableModel;
    protected $inputsValidation;
    protected $inputsEditValidation;
    protected $inputsValidationMessages;
    protected $tableColumns;

    public function __construct($model_name = '')
    {
        $this->controllerName = strtolower(
            str_replace(
                'Controller', '',
                str_replace(
                    __NAMESPACE__ . '\\', '',
                    get_class($this)
                )
            )
        );

        $this->path = '/dashboard/'.$this->controllerName.'s/';
        $this->imagePath = 'uploads/' . $this->controllerName . '/';
        $this->pageTitle = ucfirst($this->controllerName);
        $model_name = ($model_name === '') ? $this->pageTitle : $model_name;

        if(class_exists("App\Models\dashboard\\$model_name")){
            $class = "App\Models\dashboard\\$model_name";
        }else{
            $class = "App\Models\\$model_name";
        }
        try {
            $this->tableModel = new $class();

        } catch (\Exception $e) {
        }
        $this->tableName = $this->tableModel->getTable();
        $this->tablePk = DashboardController::PRIMARY_KEY;
        $this->tableColumns = Schema::getColumnListing($this->tableModel);

    }

    public function index(Request $request)
    {
        $this->authorize($this->controllerName.'-view');

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        //Search on database
        $keyword = $request->input('search');
        if ($keyword) {
            $display['data'] = $this->tableModel->SearchByKeyword($keyword)->orderBy($this->tablePk, 'desc')->get();
        } else {
            $display['data'] = $this->tableModel->orderBy($this->tablePk, 'desc')->paginate(20);
            $display['totalResult'] = $this->tableModel->count();
        }

        return view('dashboard.index')->with($display);
    }

    public function create()
    {
        $this->authorize($this->controllerName.'-create');

        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle . ' | Create';
        $display['pageName'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['inputs'] = $this->tableColumns;
        return view('dashboard.create')->with($display);
    }
}
