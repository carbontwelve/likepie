<?php namespace App\Controllers\Auth;

use BaseController;
use View;

Class UserSessionController extends BaseController
{

    public function create()
    {

        return View::make('frontend.auth.login');

    }

    public function destroy()
    {

    }

}
