<?php namespace Likepie\Classification;

use Likepie\Classification\Taxons\Taxon;

class Category extends Taxon
{
    const TAXONOMY_NAME = 'Category';

    public $presenter = 'Likepie\Classification\CategoryPresenter';

}
