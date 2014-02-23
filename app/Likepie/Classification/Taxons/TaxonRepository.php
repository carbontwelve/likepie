<?php namespace Likepie\Classification\Taxons;

use Likepie\Core\EloquentRepository;

class TaxonRepository extends EloquentRepository
{

    public function __construct(Taxon $model)
    {
        $this->model = $model;
    }

    public function getForm()
    {
        return new TaxonForm();
    }

}
