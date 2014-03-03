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

    /**
     * Which validation should we undertake, create or update?
     * @var string
     */
    protected $mode = 'create';

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }

    protected function beforeValidation()
    {
        switch ($this->mode)
        {
            case 'create':

                break;

            case 'update':

                $this->validationRules['email'] .= ",{$this->inputData['email']},email";

                if ( isset($this->inputData['password']) && $this->inputData['password'] === '')
                {
                    unset($this->validationRules['password']);
                    unset($this->validationRules['password_confirm']);
                }

                break;
        }
    }
}
