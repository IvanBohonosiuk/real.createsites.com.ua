<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ProjectsRequest as StoreRequest;
use App\Http\Requests\ProjectsRequest as UpdateRequest;

class ProjectsCrudController extends CrudController {

    public function setUp() {

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/
        $this->crud->setModel("App\Models\Projects");
        $this->crud->setRoute("admin/projects");
        $this->crud->setEntityNameStrings('projects', 'projects');

        /*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

        $this->crud->setFromDb();

        $array_of_arrays = [
            [ // Text
                'name' => 'title',
                'label' => "Title",
                'type' => 'text',
                // optional
                //'prefix' => '',
                //'suffix' => ''
            ],
            [   // WYSIWYG Editor
                'name' => 'description',
                'label' => 'Description',
                'type' => 'wysiwyg'
            ],
            [   // Checkbox
                'name' => 'active',
                'label' => 'Active',
                'type' => 'checkbox'
            ],
//            [   // Date
//                'name' => 'end_date',
//                'label' => 'End date',
//                'type' => 'date'
//            ],
            [   // Number
                'name' => 'price',
                'label' => 'Price',
                'type' => 'number',
                // optionals
                'prefix' => "$",
                'suffix' => ".00",
            ],
//            [   // Upload
//                'name' => 'image',
//                'label' => 'Image',
//                'type' => 'upload_multiple',
//                'upload' => true,
//                'disk' => 'uploads' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
//            ],
//            [   // Upload
//                'name' => 'files',
//                'label' => 'Files',
//                'type' => 'upload_multiple',
//                'upload' => true,
//                'disk' => 'uploads' // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
//            ],
            [   // Checkbox
                'name' => 'remote',
                'label' => 'Remote',
                'type' => 'checkbox'
            ],
            [  // Select2
                'label' => "User",
                'type' => 'select2',
                'name' => 'user_id', // the db column for the foreign key
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model' => "App\User" // foreign key model
            ],
            [       // Select2Multiple = n-n relationship (with pivot table)
                'label' => "Categories",
                'type' => 'select2_multiple',
                'name' => 'categories', // the method that defines the relationship in your Model
                'entity' => 'categories', // the method that defines the relationship in your Model
                'attribute' => 'title', // foreign key attribute that is shown to user
                'model' => "App\Models\ProjectCats", // foreign key model
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            ]
        ];

        $array_of_names = [
            'image',
            'files',
            'end_date'
        ];

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->setColumns([
            [
                'name' => 'id',
                'label' => 'ID'
            ],
            [
                'name' => 'title', // The db column name
                'label' => "Title" // Table column heading
            ],
            'description',
            [
                'name' => 'active', // The db column name
                'label' => "Active", // Table column heading
                'type' => 'boolean'
            ],
            'end_date',
            'price',
            'status',
            [
                'name' => 'remote', // The db column name
                'label' => "Remote", // Table column heading
                'type' => 'boolean'
            ],
            [
                // 1-n relationship
                'label' => "User", // Table column heading
                'type' => "select",
                'name' => 'user_id', // the column that contains the ID of that connected entity;
                'entity' => 'user', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "App\User", // foreign key model
            ],
            [
                // n-n relationship (with pivot table)
                'label' => "Categories", // Table column heading
                'type' => "select_multiple",
                'name' => 'categories', // the method that defines the relationship in your Model
                'entity' => 'categories', // the method that defines the relationship in your Model
                'attribute' => "title", // foreign key attribute that is shown to user
                'model' => "App\Models\ProjectCats", // foreign key model
            ],
        ]);
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
//         $this->crud->removeColumns(['image', 'files']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        $this->crud->addButtonFromModelFunction('line', 'Activate', 'activateProject', 'beginning'); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        $this->crud->allowAccess(['show']);
        $this->crud->denyAccess(['create', 'update', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
//         $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();


        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
//         $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
//         $this->crud->orderBy('id', 'desc');
//         $this->crud->groupBy('id');
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
