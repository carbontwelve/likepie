<?php namespace Likepie\Classification;

use Likepie\Classification\Taxons\Taxon;

class Tag extends Taxon
{
    const TAXONOMY_NAME = 'Tag';

    public $presenter = 'Likepie\Classification\TagPresenter';

    public function articles()
    {
        return $this->morphedByMany('Likepie\Articles\Article', 'taxons_relationship', 'classifiable_id', 'taxon_id')
            ->where('taxonomy', static::TAXONOMY_NAME);
    }
}
