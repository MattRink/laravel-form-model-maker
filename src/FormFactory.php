<?php

namespace MattRink\ModelFormMaker\FormFactory;

use Illuminate\Database\Eloquent\Model;

class FormFactory
{
    /**
     * Factory method for creating form objects.
     * 
     * @return \MattRink\ModelFormMaker\Form
     */
    public static function create(Model $model)
    {
        return new Form($this);
    }
}