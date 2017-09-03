<?php

namespace MattRink\LaravelModelFormMaker\Traits;

use MattRink\LaravelModelFormMaker\ModelFormMaker;

trait GeneratesForm
{
    /**
     * Declares the model properties/attributes to be included in a form. 
     * Defaults to all properties if empty.
     * @var array
     */
    protected $formFields = [];

    /**
     * 
     */
    public function form()
    {
        $form = new ModelFormMaker($this);
        return $form->make();
    }
}