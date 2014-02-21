<?php namespace Likepie\Classification\Taxonomy;

use Likepie\Core\EloquentRepository;

class TaxonomyRepository extends EloquentRepository
{

    public function __construct(Taxonomy $model)
    {
        $this->model = $model;
    }

}
