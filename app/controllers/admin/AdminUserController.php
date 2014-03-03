<?php namespace App\Controllers\Admin;

use Likepie\Accounts\Users\UserRepository;
use Sentry;
use Input;
use View;

/**
 * Class AdminUserController
 * @package App\Controllers\Admin
 */
class AdminUserController extends AdminBaseController {

    /** @var \Likepie\Accounts\Users\UserRepository */
    private $users;

    /** @var \Cartalyst\Sentry\Users\UserRepositoryInterface */
    private $sentryUserRepository;

    /** @var \Cartalyst\Sentry\Groups\GroupRepositoryInterface  */
    private $groups;

    public function __construct( UserRepository $users )
    {
        $this->users  = $users;
        $this->sentryUserRepository = Sentry::getUserRepository();
        $this->groups = Sentry::getGroupRepository();
    }

    public function index()
    {
        return View::make('backend.users.index')
            ->with( 'users', $this->users->getAllPaginated() );
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

        $user = $this->sentryUserRepository->create(Input::only('first_name', 'last_name', 'email', 'password', 'activated'));

        if ( $user === false ) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        $user->groups()->sync(Input::only('group'));

        return $this->redirectToRoute('admin.groups.edit', ['id' => $user->id])
            ->with('success', 'New user has been saved successfully');

    }
}
