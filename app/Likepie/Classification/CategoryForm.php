<?php namespace Likepie\Classification;

use Likepie\Core\FormModel;

class CategoryForm extends FormModel
{
    protected $validationRules = [
        'name'    => 'required',
    ];
}
