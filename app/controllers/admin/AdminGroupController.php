<?php namespace App\Controllers\Admin;

use Likepie\Accounts\Groups\GroupRepository;
use Sentry;
use Config;
use Input;
use View;

/**
 * Class AdminGroupController
 * @package App\Controllers\Admin
 */
class AdminGroupController extends AdminBaseController {

    /** @var \Cartalyst\Sentry\Groups\GroupRepositoryInterface  */
    private $sentryGroupRepository;

    /**
     * @var \Likepie\Accounts\Groups\GroupRepository
     */
    private $groups;

    /**
     * Loaded Permissions
     * @var array
     */
    private $permissions;

    /**
     *
     * @param GroupRepository $groups
     */
    public function __construct( GroupRepository $groups )
    {
        parent::__construct();

        $this->sentryGroupRepository = Sentry::getGroupRepository();
        $this->groups                = $groups;
        $this->permissions           = Config::get('permissions');

        $this->encodeAllPermissions($this->permissions, true);
    }

    public function index()
    {
        return View::make('backend.groups.index')
            ->with('groups', $this->groups->getAllPaginated());
    }

    public function create()
    {
        return View::make('backend.groups.create',
        [
            'permissions'         => $this->permissions,
            'selectedPermissions' => Input::old('permissions', array())
        ]);
    }

    public function store()
    {
        $form = $this->groups->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $this->setPermissionsFromInput();

        $group = $this->groups->getNew( Input::only(['name', 'permissions']) );

        if ( ! $group->save() ) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.groups.edit', ['id' => $group->id])
            ->with('success', 'New group has been saved successfully');
    }

    public function edit($id = null)
    {
        $group = $this->groups->findById($id);
        $groupPermissions = $group->permissions;
        $this->encodePermissions($groupPermissions);
        $groupPermissions = array_merge($groupPermissions, Input::old('permissions', array()));

        return View::make('backend.groups.edit',
            [
                'group'               => $group,
                'permissions'         => $this->permissions,
                'selectedPermissions' => $groupPermissions
            ]
        );
    }

    public function update($id = null)
    {
        $form = $this->groups->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $this->setPermissionsFromInput();

        $group = $this->groups->findById($id);
        $group->fill( Input::only(['name', 'permissions']));

        if ( ! $group->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.groups.edit', ['id' => $group->id])
            ->with('success', 'Group has been updated successfully');
    }
}
