<?php namespace Likepie\Classification;

use Likepie\Classification\Taxons\Taxon;

class Tag extends Taxon
{

    public $presenter = 'Likepie\Classification\TagPresenter';

    /**
     * Limit Taxons to Just those with category type
     *
     * @param bool $excludeDeleted
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
        $query->where('taxonomic_unit_id', '=', 1);
        return $query;
    }
}
