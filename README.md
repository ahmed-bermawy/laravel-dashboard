<p align="center">
<a href="https://incubator-eg.com" target="_blank">
<img src="https://incubator-eg.com/asset/img/brand.png" width="400"></a></p>

[//]: # (<p align="center">)

[//]: # (<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>)

[//]: # (<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>)

[//]: # (</p>)

# Incubator Dashboard

## This is steps to install website dashboard

### 1. Make sure you have nodejs, npm and bower installed on your machine

```bash
sudo add-apt-repository ppa:chris-lea/node.js
```

```bash
sudo apt-get update
```

```bash
sudo apt-get install nodejs
```

```bash
sudo apt install yarn
```

### 2. Install laravel through composer

you can add the version of laravel at the end for example  "8.*" , Remember to change blog for what name you like of
your project folder

```pash
composer create-project --prefer-dist laravel/laravel laravel_dashboard
```

### 3. Install Dashboard

#### A. Add in composer.json after scripts tag

```json
"repositories": [
{
"type": "path",
"url": "Incubator/Dashboard"
}
]
```

#### B. Run composer require PackageName

```bash
composer require incubator/dashboard:dev-main
```

#### C. Publish package files

```bash
php artisan vendor:publish --tag=dashboard --force
```

### 4. Make sure that you have created a database and modified the env file

### 5. Install package dependencies

```bash 
php artisan dashboard:setup
```

This command will Install AdminLte package, install Spatie permission, install Fontawesome package, and install
LaravelCollective package

### 6. Publish package dependencies files

```bash
php artisan vendor:publish --all --force
```

This command will publish dependencies packages files

### 7. Run migrate to install databases

```bash
php artisan migrate
```

### 8. Seed data

```bash
php artisan dashboard:seed
```

This command will seed data from seeders to database and edit webpack.mix.js put package assets files paths in to
webpack.mix.js to compile and minimize them at next step

### 9. Compile and minimize scss & js files by laravel mix

```bash
npm run dev
```

### 10. Run the website on the server

```bash
php artisan serve
```

> default username => admin@admin.com \
> default password => 12345678

# Incubator/Dashboard Structure

- src
-
    - assets
-
    -
        - css
-
    -
        - img
-
    -
        - js
-
    -
        - sass
-
    - config
-
    - console
-
    -
        - Commands
-
    - database
-
    -
        - migrations
-
    -
        - seeders
-
    - Http
-
    -
        - Controllers
-
    -
        -
            - Auth
-
    -
        - Requests
-
    - Models
-
    - Packages
-
    - routes
-
    - traits
-
    - views
-
    -
        - auth
-
    -
        - components
-
    -
        -
            - customjs
-
    -
        -
            - formComponents
-
    -
        - errors
-
    -
        - layouts
-
    -
        - roles
-
    - DashboardServiceProvider
-
    - FilesServiceProvider
- composer.json
- composer.lock

# Overview Incubator/Dashboard

## Controllers

#### Controller variables

```php
    protected $path; // $path => blade route
    protected $pageTitle; // $pageTitle => blade Title
    protected $tableName; // $tableName => table name in database  
    protected $tablePk; // $tablePk =>primary key 
    protected $imagePath; // this controller file upload path 
    protected $tableModel; // this controller model name 
    protected $inputsValidation; //array of inputs with their rules when create record
    protected $inputsEditValidation; //array of inputs with their rules when update record
    protected $inputsValidationMessages; //array of customize message when validation fail
    /**
    * array of columns with their data 
    * database name,
    * blade title,
    * hint message,
    * array of data, when column type [select,checkbox,radio] 
    * image path, when input type [file, image] 
    */
    protected $tableColumns; 

```

#### Create controller

In constructor, you must call parent constructor with your controller model name and initialize [$inputsValidation]()
, [$inputsEditValidation](), [$inputsValidationMessages]()
,[$tableColumns]()

```php 
class ControllerName extends DashboardController
{
    public function __construct()
    {
        parent::__construct('ModelName');
        $this->inputsValidation = [];
        $this->inputsEditValidation = [];
        $this->inputsValidationMessages = [];
        $this->tableColumns = [];
     }
 }

```

# How to

## A. Create Inputs

### 1. Create input with type text

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'text',
        'message' => 'Any hint message like Required',
    ],
];
```

### 2. Create input with type textarea

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'textarea',
        'message' => 'Any hint message like Required',
    ],
];
```

### 3. Create input with type editor

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'editor',
        'message' => 'Any hint message like Required',
    ],
];
```

### 4. Create input with type image

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'image',
        'filePath' => $this->imagePath,
        'message' => 'Any hint message like Allowed Extension:jpeg,png,jpg,gif - Max Size 2MB',
    ],
];
```

### 5. Create input with type file

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'file',
        'filePath' => $this->imagePath,
        'message' => 'Allowed Extension:pdf - Max Size 2MB',
    ],
];
```

### 6. Create input with type select

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'select',
        'arrayOfData' => 
            [
                ['key' => 1, 'value' => 'false'],
                ['key' => 2, 'value' => 'true'],
             ],
        'message' => 'Required',
    ],
];
```

### 7. Create input with type select

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'radio',
        'message' => 'Required',
        'arrayOfData' => 
            [
                ['key' => 'yes', 'value' => true],
                ['key' => 'no', 'value' => false],
            ],
    ],
];
```

### 8. Create input with type checkboxList

In your controller put this code in [$tableColumns]() variable you can set arrayOfData value from database

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'checkboxList',
        'arrayOfData' => ModelName::all(['id as key', 'name as value']),
    ],
];
```

### 9. Create input with type date

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'date',
        'format' => 'date',
        'message' => 'Required',
    ],
];
```

### 10. Create input with type dateTime

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'date',
        'format' => 'dateTime',
        'message' => 'Required',
    ],
];
```

### 11. Create input with type password

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'password',
        'message' => 'Required',
    ],
];
```

### 12. Create input with type hidden

In your controller put this code in [$tableColumns]() variable

```php
$tableColumns = [
    [
        'columnName' => 'input name in database ',
        'title' => 'input title in view ',
        'type' => 'hidden',
        'message' => 'Required',
        'value'=>'any value '
    ],
];
```

## Notes

#### 1. Make input searchable in index blade in custom search

> if you want to make your input searchable, just add
> ```php 
>    'canSearch' => true,
> ```
> in your input array like this
> ```php
> $tableColumns = [
>    [
>        'columnName' => 'input name in database ',
>        'title' => 'input title in view ',
>        'type' => 'text',
>        'message' => 'Any hint message like Required',
>        'canSearch' => true,
>    ],
>];
> ```

#### 2. Make input order-able in index blade

> if you want to make your input order-able, just add
> ```php 
>    'canOrder' => true,
> ```
> in your input array like this
> ```php
> $tableColumns = [
>    [
>        'columnName' => 'input name in database ',
>        'title' => 'input title in view ',
>        'type' => 'text',
>        'message' => 'Any hint message like Required',
>        'canOrder' => true,
>    ],
>];
> ```

## B. Make input validation

### 1. Validate input when create new record

```php
$inputsValidation = [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
];
```

### 2. Validate input when update record

```php
$inputsEditValidation = [
            'name' => 'required|min:3',
            'description' => 'required|min:10',
];
```

## C. Create controller functions

### 1. Create index function

```php
    public function index(Request $request)
    {
        $this->authorize($this->controllerName . '-view');
        $display['path'] = $this->path;
        $display['pageTitle'] = $this->pageTitle;
        $display['tableName'] = $this->tableName;
        $display['tablePk'] = $this->tablePk;
        $display['tableHeader'] = $this->tableColumns;
        $display['message'] = session('message');
        $display['data'] = $this->tableModel->orderBy('id', 'desc')->paginate(20);
        $display['data']->appends(request()->query()); //to merge query string with pagination url
        return view('dashboard.index')->with($display);
```

#### Notes

##### Use search,order and custom search with Controller

```php
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
        $customSearch = $request->input('customSearch');
        $order = $request->input('order');
        // custom search start
        if ($customSearch) {
            if ($request->only('columnName')) { //checkboxList  columnName
                $display['data'] = $this->tableModel->SearchByKeywordAndColumn($request->except(['customSearch', 'dir', 'order']), 'relationName', $request->only('columnName'))
                    ->orderBy($order ?? 'id', $request->input('dir') ?? 'desc')->paginate(20);
                    //SearchByKeywordAndColumn(request ,relationName in model,request -> columnName)
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
```
