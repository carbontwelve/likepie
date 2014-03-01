<?php namespace App\Controllers\Admin;

use Likepie\Accounts\UserRepository;
use Sentry;
use Input;
use View;

/**
 * Class AdminUserController
 * @package App\Controllers\Admin
 */
class AdminUserController extends AdminBaseController {

    /** @var \Likepie\Accounts\User $users */
    private $users;

    /** @var \Cartalyst\Sentry\Groups\GroupRepositoryInterface  */
    private $groups;

    public function __construct( UserRepository $users )
    {
        $this->users  = $users;
        $this->groups = Sentry::getGroupRepository();
    }

    public function index()
    {
        $users = $this->users->getAllPaginated();
        return View::make('backend.users.index')
            ->with('users', $users);
    }

    public function create()
    {
        return View::make('backend.users.create')
            ->with('groups', $this->groups->createModel()->get()->lists('name', 'id'));
    }

    public function store()
    {
        $form = $this->users->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        dd(Input::all());
    }
}
