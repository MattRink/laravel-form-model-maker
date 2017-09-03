<?php

namespace MattRink\ModelFormMaker;

use Illuminate\Database\Eloquent\Model;

class FormFactory
{
    /**
     * Factory method for creating form objects.
     * 
     * @return \MattRink\ModelFormMaker\Form
     */
    public static function create($type)
    {
        if (gettype($type) == 'string') {
            $model = new $type();
        } else if ($type instanceof Model) {
            $model = $type;
        } else {
            throw new Exception("Unexpected type {$type} given to FormFactory::create().");
        }
        
        return new Form($model);
    }
}