<?php namespace Likepie\Accounts\Groups;

use Cartalyst\Sentry\Groups\EloquentGroup;

class Group extends EloquentGroup
{
    /**
     * {@inheritDoc}
     */
    //protected $table       = 'groups';

    //protected $with        = ['author'];

    /**
     * {@inheritDoc}
     */
    //protected $fillable    = ['slug', 'name', 'permissions'];

    /**
     * {@inheritDoc}
     */
    //protected $hidden      = ['password'];

    /**
     * {@inheritDoc}
     */
    //protected $dates       = ['last_login'];

    /**
     * {@inheritDoc}
     */
    //protected $softDelete  = true;

    /**
     * Presenter Class
     */
    //public $presenter      = 'Likepie\Accounts\UserPresenter';

    public function save(array $options = array())
    {
        // Sentry 3 seems not to have this as default yet, not sure if that is an oversight or not :/
        $this->slug = \Str::slug($this->name);
        return parent::save();
    }

}
