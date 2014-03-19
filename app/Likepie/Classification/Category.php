<?php namespace Likepie\Classification;

use Likepie\Classification\Taxons\Taxon;

class Category extends Taxon
{
    const TAXONOMY_NAME = 'Category';

    public $presenter = 'Likepie\Classification\CategoryPresenter';

    public function articles()
    {
        return $this->morphedByMany('Likepie\Articles\Article', 'taxons_relationship', 'classifiable_id', 'taxon_id');
    }
}
