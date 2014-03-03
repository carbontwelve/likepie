<?php namespace Likepie\Accounts\Users;

use Likepie\Core\EloquentRepository;

class UserRepository extends EloquentRepository
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new UserForm();
    }
}
