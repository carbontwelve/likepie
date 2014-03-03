<?php namespace Likepie\Accounts\Users;

use Cartalyst\Sentry\Users\EloquentUser;

class User extends EloquentUser
{

    /**
     * {@inheritDoc}
     */
    protected $dates       = ['last_login'];

    /**
     * Presenter Class
     */
    public $presenter      = 'Likepie\Accounts\Users\UserPresenter';
}
