<?php namespace App\Controllers\Admin;

use Likepie\Accounts\Users\UserRepository;
use Config;
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

    /**
     * Loaded Permissions
     * @var array
     */
    private $permissions;

    /**
     * @param UserRepository $users
     */
    public function __construct( UserRepository $users )
    {
        $this->users                = $users;
        $this->sentryUserRepository = Sentry::getUserRepository();
        $this->groups               = Sentry::getGroupRepository();
        $this->permissions          = Config::get('permissions');

        $this->encodeAllPermissions($this->permissions, false);
    }

    public function index()
    {
        return View::make('backend.users.index')
            ->with( 'users', $this->users->getAllPaginated() );
    }

    public function create()
    {
        return View::make('backend.users.create')
            ->with('groups', $this->groups->createModel()->get()->lists('name', 'id'))
            ->with('permissions', $this->permissions)
            ->with('selectedPermissions', Input::old('permissions', array( 'superuser' => -1 )));
    }

    public function store()
    {
        $form = $this->users->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        // Update Permissions GET params
        $permissions = Input::get('permissions', array());
        $this->decodePermissions($permissions);
        app('request')->request->set('permissions', $permissions);

        $user = $this->sentryUserRepository->create(Input::only('first_name', 'last_name', 'email', 'password', 'activated', 'permissions'));

        if ( $user === false ) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        $user->groups()->sync(Input::only('group'));

        return $this->redirectToRoute('admin.users.edit', ['id' => $user->id])
            ->with('success', 'New user has been saved successfully');
    }

    public function edit($id = null)
    {

        $user = $this->sentryUserRepository->findById($id);

        if (is_null($user))
        {
            return $this->redirectToRoute('admin.users.index')
                ->with('error', 'That user record does not exist and therefore can not be edited.');
        }

        $userPermissions = $user->permissions;
        $this->encodePermissions($userPermissions);
        $userPermissions = array_merge($userPermissions, Input::old('permissions', array( 'superuser' => -1 )));

        return View::make('backend.users.edit')
            ->with('user', $user )
            ->with('groups', $this->groups->createModel()->get()->lists('name', 'id'))
            ->with('permissions', $this->permissions)
            ->with('selectedPermissions', $userPermissions);
    }

    public function update( $id = null )
    {
        $user = $this->sentryUserRepository->findById($id);

        if (is_null($user))
        {
            return $this->redirectToRoute('admin.users.index')
                ->with('error', 'That user record does not exist and therefore can not be edited.');
        }

        $form = $this->users->getForm();
        $form->setMode('update');

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $inputForSave = Input::only('first_name', 'last_name', 'email', 'password', 'activated');

        if ($inputForSave['password'] == '')
        {
            unset($inputForSave['password']);
        }

        $user = $this->sentryUserRepository->update($user, $inputForSave);
        $user->groups()->sync(Input::only('group'));

        return $this->redirectToRoute('admin.users.edit', ['id' => $user->id])
            ->with('success', 'Record updated successfully');
    }

}
