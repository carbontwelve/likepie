<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminTaxonomyUnitsController
 * @package App\Controllers\Admin
 */
class AdminTaxonomyUnitsController extends AdminBaseController {

    public function index()
    {
        return View::make('backend.taxonomyUnits.index');
    }
}
