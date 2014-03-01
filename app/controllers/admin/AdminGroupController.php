<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminGroupController
 * @package App\Controllers\Admin
 */
class AdminGroupController extends AdminBaseController {

    public function __construct()
    {

    }

    public function index()
    {
        return View::make('backend.groups.index');
    }
}
