<?php namespace Likepie\Accounts\Groups;

use Cartalyst\Sentry\Groups\GroupRepositoryInterface;
use Likepie\Core\EloquentRepository;

class GroupRepository extends EloquentRepository implements GroupRepositoryInterface
{

    public function __construct(Group $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new GroupForm();
    }

    /**
     * Finds a group by the given slug.
     *
     * @param  string $slug
     * @return \Cartalyst\Sentry\Groups\GroupInterface
     */
    public function findBySlug($slug)
    {
        return $this->model
            ->newQuery()
            ->with('users')
            ->where('slug', $slug)
            ->first();
    }
}
