<?php namespace Likepie\Accounts;

use Likepie\Core\EloquentRepository;

class UserRepository extends EloquentRepository
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

}
