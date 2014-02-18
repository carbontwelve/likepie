<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminDashboardController
 * @package App\Controllers\Admin
 */
class AdminDashboardController extends AdminBaseController {

    public function index()
    {

        return View::make('backend.dashboard');

    }

}
