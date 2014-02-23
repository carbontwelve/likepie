<?php namespace Likepie\Classification\Taxons;

use Likepie\Core\FormModel;

class TaxonForm extends FormModel
{
    protected $validationRules = [
        'name'    => 'required',
    ];
}
