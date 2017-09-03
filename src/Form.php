<?php

namespace MattRink\ModelFormMaker;

use Illuminate\Database\Eloquent\Model;


class Form
{
    /**
     * The model's attributes
     * 
     * @var array
     */
    protected $modelAttributes = [];

    /**
     * The model's attributes to include in the form.
     * 
     * Taken from the model's form fields property. If empty all attributes/fields.
     * 
     * @var array
     */
    protected $formFields = [];

    /**
     * The model that we are generating a form for.
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Constructor for initial form setup.
     * 
     * @return void
     */
    public function __construct($model)
    {
        $this->modelAttributes = $model->getModelAttributes();
        $this->formFields = $model->getFormFields();
        $this->model = $model;
    }

    /**
     * Returns the generated form
     * 
     * @return string
     */
    public function show()
    {
        $fields = (count($this->formFields) ? array_intersect($this->modelAttributes, $this->formFields) : $this->modelAttributes);

        $form = '';
        foreach ($fields as $field) {
            $form .= Form::text($field, $this->model->{$field});
        }

        return $form;
    }
}