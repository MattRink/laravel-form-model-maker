<?php

namespace MattRink\ModelFormMaker\Traits;

use MattRink\ModelFormMaker\FormFactory;

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
     * 
     */
    public function form()
    {
        $form = FormFactory::create($this);
        return $form->show();
    }
}