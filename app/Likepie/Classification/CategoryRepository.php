<?php namespace Likepie\Classification;

use Likepie\Core\EloquentRepository;

class CategoryRepository extends EloquentRepository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new CategoryForm();
    }
}
