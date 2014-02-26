<?php namespace Likepie\Classification;

use Likepie\Core\EloquentRepository;

class TagRepository extends EloquentRepository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new TagForm();
    }
}
