<?php namespace Likepie\Accounts\Groups;

use Likepie\Core\FormModel;

class GroupForm extends FormModel
{
    protected $validationRules = [
        'name' => 'required|min:3',
    ];
}
