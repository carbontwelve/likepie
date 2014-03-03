<?php namespace Likepie\Accounts\Users;

use Likepie\Core\FormModel;

class UserForm extends FormModel
{
    protected $validationRules = [
        'first_name'       => 'required|min:3',
        'last_name'        => 'required|min:3',
        'email'            => 'required|email|unique:users,email',
        'password'         => 'required|between:3,32',
        'password_confirm' => 'required|between:3,32|same:password',
    ];
}
