<?php namespace Likepie\Accounts;

use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

class User extends Ardent
{

    protected $table       = 'users';

    //protected $with        = ['author'];

    protected $fillable    = ['email', 'password', 'last_login', 'first_name' ,'last_name'];

    protected $hidden      = ['password'];

    protected $dates       = ['last_login'];

    protected $softDelete  = true;

    public $presenter      = 'Likepie\Accounts\UserPresenter';

}
