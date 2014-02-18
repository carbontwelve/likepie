<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminUserController
 * @package App\Controllers\Admin
 */
class AdminUserController extends AdminBaseController {

    public function index()
    {
        return View::make('backend.users.index');
    }
}
