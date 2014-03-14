<?php namespace Likepie\Accounts;

use Likepie\Core\FormModel;

class AuthForm extends FormModel
{
    protected $validationRules = [
        'email'            => 'required|email',
        'password'         => 'required|between:3,32',
    ];
}
