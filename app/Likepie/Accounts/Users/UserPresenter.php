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

    /**
     * Returns the users gravatar image url generated from email
     * @return string
     */
    public function gravatar()
    {
        $gravatar = md5(strtolower(trim($this->resource->email)));
        return "//gravatar.org/avatar/{$gravatar}";
    }
}
