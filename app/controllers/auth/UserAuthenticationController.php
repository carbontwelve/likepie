<?php namespace App\Controllers\Auth;

use BaseController;
use View;

Class UserAuthenticationController extends BaseController
{


	public function login()
	{

        return View::make('frontend.auth.login');

	}


}
