<?php namespace Likepie\Classification;

use Likepie\Core\FormModel;

class TagForm extends FormModel
{
    protected $validationRules = [
        'name'    => 'required',
    ];
}
