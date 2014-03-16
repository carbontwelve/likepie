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

    protected $with        = ['activation', 'groups'];

    /**
     * The activations class
     *
     * @var string
     */
    protected static $activationModel = 'Cartalyst\Sentry\Activations\EloquentActivation';

    /**
     * User Activation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activation()
    {
        return $this->hasOne(static::$activationModel, 'user_id');
    }

    public function articles()
    {
        return $this->hasMany('Likepie\Articles\Article', 'author_id');
    }
}
