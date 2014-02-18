<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminPermissionController
 * @package App\Controllers\Admin
 */
class AdminPermissionController extends AdminBaseController {

    public function index()
    {
        return View::make('backend.permissions.index');
    }
}
