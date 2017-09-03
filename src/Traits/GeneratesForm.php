<?php

namespace MattRink\ModelFormMaker\Traits;

use MattRink\ModelFormMaker\FormFactory;
use Illuminate\Support\Faceds\DB;

trait GeneratesForm
{
    /**
     * Declares the model properties/attributes to be included in a form. 
     * Defaults to all properties if empty.
     * @var array
     */
    protected $formFields = [];

    /**
     * Getter for the form fields property
     * 
     * @return array
     */
    public function getFormFields()
    {
        return $this->formFields;
    }

    /**
     * See: https://stackoverflow.com/questions/23396138/laravel-eloquent-model-attributes
     */
    protected function getAllColumnsNames()
    {
        switch (DB::connection()->getConfig('driver')) {
            case 'pgsql':
                $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$this->getTable()."'";
                $column_name = 'column_name';
                $reverse = true;
                break;

            case 'mysql':
                $query = 'SHOW COLUMNS FROM '.$this->getTable();
                $column_name = 'Field';
                $reverse = false;
                break;

            case 'sqlsrv':
                $parts = explode('.', $this->getTable());
                $num = (count($parts) - 1);
                $table = $parts[$num];
                $query = "SELECT column_name FROM ".DB::connection()->getConfig('database').".INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'".$table."'";
                $column_name = 'column_name';
                $reverse = false;
                break;

            default: 
                $error = 'Database driver not supported: '.DB::connection()->getConfig('driver');
                throw new Exception($error);
                break;
        }

        $columns = array();

        foreach(DB::select($query) as $column) {
            $columns[$column->$column_name] = $column->$column_name; // setting the column name as key too
        }

        if($reverse) {
            $columns = array_reverse($columns);
        }

        return $columns;
    }

    /**
     * 
     */
    public function getModelAttributes() {
        if (!count($this->getAttributes())) {
            $this->getAllColumnsNames();
        } else {
            return $this->getAttributes();
        }
    }

    /**
     * 
     */
    public function form()
    {
        $form = FormFactory::create($this);
        return $form->show();
    }
}