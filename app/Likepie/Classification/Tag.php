<?php namespace Likepie\Classification;

use Likepie\Classification\Taxons\Taxon;

class Tag extends Taxon
{
    const TAXONOMY_NAME = 'Tag';

    public $presenter = 'Likepie\Classification\TagPresenter';

}
