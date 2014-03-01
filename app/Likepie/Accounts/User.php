<?php namespace Likepie\Accounts;

use Cartalyst\Sentry\Groups\GroupableInterface;
use Cartalyst\Sentry\Permissions\PermissibleInterface;
use Cartalyst\Sentry\Persistence\PersistableInterface;
use Cartalyst\Sentry\Users\UserInterface;
use LaravelBook\Ardent\Ardent;
use Closure;
use Str;

/**
 * Class User
 * A majority of the methods below were taken from Sentry 3.0.0
 * so that my user model could extend Ardent
 * @package Likepie\Accounts
 */
class User extends Ardent implements GroupableInterface, PermissibleInterface, PersistableInterface, UserInterface
{

    /**
     * {@inheritDoc}
     */
    protected $table       = 'users';

    //protected $with        = ['author'];

    /**
     * {@inheritDoc}
     */
    protected $fillable    = ['email', 'password', 'permissions', 'last_login', 'first_name' ,'last_name'];

    /**
     * {@inheritDoc}
     */
    protected $hidden      = ['password'];

    /**
     * {@inheritDoc}
     */
    protected $dates       = ['last_login'];

    /**
     * {@inheritDoc}
     */
    protected $softDelete  = true;

    /**
     * Presenter Class
     */
    public $presenter      = 'Likepie\Accounts\UserPresenter';

    /**
     * {@inheritDoc}
     */
    public static $rules   = [
        'first_name'       => 'required|min:3',
        'last_name'        => 'required|min:3',
        'email'            => 'required|email|unique:users,email',
        'password'         => 'required|between:3,32',
        'password_confirm' => 'required|between:3,32|same:password',
    ];

    /**
     * Cached permissions instance for the given user.
     *
     * @var \Cartalyst\Sentry\Permissions\PermissionsInterface
     */
    protected $permissionsInstance;

    /**
     * Array of login column names.
     *
     * @var array
     */
    protected $loginNames = array('email');

    /**
     * The groups model name.
     *
     * @var string
     */
    protected static $groupsModel = 'Cartalyst\Sentry\Groups\EloquentGroup';

    /**
     * Returns an array of login column names.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @return array
     */
    public function getLoginNames()
    {
        return $this->loginNames;
    }

    /**
     * Groups relationship.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(static::$groupsModel, 'groups_users', 'user_id', 'group_id')->withTimestamps();
    }

    /**
     * Get mutator for the "persistence codes" attribute.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  mixed  $codes
     * @return array
     */
    public function getPersistenceCodesAttribute($codes)
    {
        return $codes ? json_decode($codes, true) : array();
    }

    /**
     * Set mutator for the "persistence codes" attribute.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  mixed  $codes
     * @return void
     */
    public function setPersistenceCodesAttribute(array $codes)
    {
        $this->attributes['persistence_codes'] = $codes ? json_encode(array_values($codes)) : '';
    }

    /**
     * Get mutator for the "permissions" attribute.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  mixed  $permissions
     * @return array
     */
    public function getPermissionsAttribute($permissions)
    {
        return $permissions ? json_decode($permissions, true) : array();
    }

    /**
     * Set mutator for the "permissions" attribute.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  mixed  $permissions
     * @return void
     */
    public function setPermissionsAttribute(array $permissions)
    {
        $this->attributes['permissions'] = $permissions ? json_encode($permissions) : '';
    }

    /**
     * {@inheritDoc}
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * {@inheritDoc}
     */
    public function inGroup($group)
    {
        $group = array_first($this->groups, function($index, $instance) use ($group)
            {
                if ($group instanceof GroupInterface)
                {
                    return ($instance === $group);
                }

                if ($instance->getGroupId() == $group)
                {
                    return true;
                }

                if ($instance->getGroupSlug() == $group)
                {
                    return true;
                }

                return false;
            });

        return ($group !== null);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissions()
    {
        if ($this->permissionsInstance === null)
        {
            $this->permissionsInstance = $this->createPermissions();
        }

        return $this->permissionsInstance;
    }

    /**
     * {@inheritDoc}
     */
    public function generatePersistenceCode()
    {
        return str_random(32);
    }

    /**
     * {@inheritDoc}
     */
    public function getPersistenceCodes()
    {
        return $this->persistence_codes;
    }

    /**
     * {@inheritDoc}
     */
    public function addPersistenceCode($code)
    {
        $codes = $this->persistence_codes;
        $codes[] = $code;
        $this->persistence_codes = $codes;
    }

    /**
     * {@inheritDoc}
     */
    public function removePersistenceCode($code)
    {
        $codes = $this->persistence_codes;

        $index = array_search($code, $codes);

        if ($index !== false)
        {
            unset($codes[$index]);
        }

        $this->persistence_codes = $codes;
    }

    /**
     * {@inheritDoc}
     */
    public function getUserId()
    {
        return $this->getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserLogin()
    {
        return $this->getAttribute($this->getUserLoginName());
    }

    /**
     * {@inheritDoc}
     */
    public function getUserLoginName()
    {
        return reset($this->loginNames);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserPassword()
    {
        return $this->password;
    }

    /**
     * Creates a permissions object.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @return \Cartalyst\Sentry\Permissions\PermissionsInterface
     */
    protected function createPermissions()
    {
        $userPermissions  = $this->permissions;
        $groupPermissions = array();

        foreach ($this->groups as $group)
        {
            $groupPermissions[] = $group->permissions;
        }

        return new SentryPermissions($userPermissions, $groupPermissions);
    }

    /**
     * Get the groups model.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @return string
     */
    public static function getGroupsModel()
    {
        return static::$groupsModel;
    }

    /**
     * Set the groups model.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  string  $groupsModel
     * @return void
     */
    public static function setGroupsModel($groupsModel)
    {
        static::$groupsModel = $groupsModel;
    }

    /**
     * Dynamically pass missing methods to the group.
     *
     * @author     Cartalyst LLC
     * @license    BSD License (3-clause)
     * @copyright  (c) 2011-2014, Cartalyst LLC
     * @link       http://cartalyst.com
     * @param  string  $method
     * @param  array   $parameters
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        $methods = array('hasAccess', 'hasAnyAccess');

        if (in_array($method, $methods))
        {
            $permissions = $this->getPermissions();

            return call_user_func_array(array($permissions, $method), $parameters);
        }

        return parent::__call($method, $parameters);
    }

}
