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
     * 
     */
    public function form()
    {
        $form = FormFactory::make($this);
        return $form->show();
    }
}