<?php namespace App\Controllers\Admin;

use BaseController;
use View;

/**
 * Class AdminBlogController
 * @package App\Controllers\Admin
 */
class AdminDashboardController extends BaseController {

    public function index()
    {

        return View::make('backend.dashboard');

    }

}
