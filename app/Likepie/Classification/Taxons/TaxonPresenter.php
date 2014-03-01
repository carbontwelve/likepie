<?php namespace Likepie\Classification\Taxons;

use McCool\LaravelAutoPresenter\BasePresenter;
use Markdown;
use Str;

class TaxonPresenter extends BasePresenter
{
    public function taxonomy()
    {
        return $this->resource->taxonomy->name;
    }


}
