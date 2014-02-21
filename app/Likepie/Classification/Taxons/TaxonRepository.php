<?php namespace Likepie\Taxons;

use Likepie\Core\EloquentRepository;

class TaxonRepository extends EloquentRepository
{

    public function __construct(Taxon $model)
    {
        $this->model = $model;
    }

}
