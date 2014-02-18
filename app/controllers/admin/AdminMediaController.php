<?php namespace App\Controllers\Admin;

use View;

/**
 * Class AdminMediaController
 * @package App\Controllers\Admin
 */
class AdminMediaController extends AdminBaseController {

    public function index()
    {
        return View::make('backend.media.index');
    }
}
