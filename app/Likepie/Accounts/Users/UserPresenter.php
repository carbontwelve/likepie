<?php namespace Likepie\Accounts\Users;

use McCool\LaravelAutoPresenter\BasePresenter;
use Markdown;
use Str;

class UserPresenter extends BasePresenter
{
    /**
     * Returns the users full name by concatenating the first and last names
     * @return string
     */
    public function fullName()
    {
        return "{$this->resource->first_name} {$this->resource->last_name}";
    }

    /**
     *
     */
    public function displayName()
    {

    }

    public function isActivated()
    {
        if (is_null($this->resource->activation))
        {
            return 'No';
        }

        if ($this->resource->activation->completed < 1)
        {
            return 'No';
        }

        return 'Yes';
    }

    public function activatedOn()
    {
        if (is_null($this->resource->activation) || ( ! is_null($this->resource->activation) && $this->resource->activation->completed < 1 ) )
        {
            return 'Never';
        }

        return $this->resource->activation->completed_at;
    }

    public function loggedInOn()
    {
        if (is_null($this->resource->last_login)){ return 'Never'; }

        return $this->resource->last_login;
    }

    /**
     * Returns the users gravatar image url generated from email
     * @return string
     */
    public function gravatar()
    {
        $gravatar = md5(strtolower(trim($this->resource->email)));
        return "//gravatar.org/avatar/{$gravatar}";
    }

    /**
     * Returns the users groups as a concatenated string separated by commas
     * @return string
     */
    public function inGroups()
    {
        // $this->resource

        if ($this->resource->groups->count() == 0)
        {
            return '<span class="text-danger">None</span>';
        }

        $groups = implode(',', $this->resource->groups->lists('name'));

        return '<span class="text-success">' . $groups . '</span>';
    }
}
