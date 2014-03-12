<?php namespace App\Controllers\Auth;

use BaseController;
use Input;
use View;

Class UserSessionController extends BaseController
{

    public function create()
    {

        return View::make('frontend.auth.login');

    }

    public function store()
    {

        dd(Input::all());

    }

    public function destroy()
    {

    }

}
