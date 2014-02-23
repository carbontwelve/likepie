<?php namespace Likepie\Classification\Taxonomy;

use Likepie\Core\FormModel;

class TaxonomyForm extends FormModel
{
    protected $validationRules = [
        'name'    => 'required',
    ];
}
