<?php namespace App\Controllers\Auth;

use BaseController;
use Cartalyst\Sentry\Checkpoints\NotActivatedException;
use Cartalyst\Sentry\Checkpoints\ThrottlingException;
use Input;
use Likepie\Accounts\AuthForm;
use View;
use Sentry;
use Redirect;

Class UserSessionController extends BaseController
{

    /**
     * @var \Likepie\Accounts\AuthForm
     */
    private $authForm;

    public function __construct( AuthForm $authForm )
    {
        $this->authForm = $authForm;
    }

    public function create()
    {
        return View::make('frontend.auth.login');
    }

    public function store()
    {

        if ( ! $this->authForm->isValid()) {
            return $this->redirectBack(['errors' => $this->authForm->getErrors()]);
        }

        $remember_me = ( Input::get('remember_me', false) !== false ) ? true : false;

        try{
            if ( ! Sentry::authenticate( ['email' => Input::get('email'), 'password' => Input::get('password')], $remember_me ) )
            {
                return $this->redirectBack(['error' => 'Sorry, please try again.']);
            }

            return Redirect::intended();
        }catch(NotActivatedException $error)
        {
            return $this->redirectBack(['error' => $error->getMessage()]);
        }catch( ThrottlingException $error)
        {
            return $this->redirectBack(['error' => $error->getMessage()]);
        }
    }

    public function destroy()
    {

    }

}
