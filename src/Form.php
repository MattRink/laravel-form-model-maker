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
     * The attributes to ignore when building the form.
     * 
     * @var array
     */
    protected $ignoredAttributes = [];

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

        $form = \Collective\Html\FormFacade::model($this->model);
        foreach ($fields as $field) {
            $form .= '<div class="form-group">';
            $form .= \Collective\Html\FormFacade::label($field, title_case($field));
            $form .= \Collective\Html\FormFacade::text($field, $this->model->{$field}, ['class' => 'form-control']);
            $form .= '</div>';
        }
        $form .= \Collective\Html\FormFacade::close();

        return $form;
    }
}