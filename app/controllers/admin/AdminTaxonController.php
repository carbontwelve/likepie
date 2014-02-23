<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminTaxonomyController
 * @package App\Controllers\Admin
 */
class AdminTaxonController extends AdminBaseController {

    public function index()
    {
        return View::make('backend.taxon.index');
    }
}
