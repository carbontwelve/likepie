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

    public function __construct( GroupRepository $groups )
    {
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
            'permissions' => $this->permissions
        ]);
    }

    public function store()
    {
        $form = $this->groups->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $group = $this->sentryGroupRepository->create(Input::only('name'));

        if ( $group === false ) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.groups.edit', ['id' => $group->id])
            ->with('success', 'New group has been saved successfully');
    }

    public function edit($id = null)
    {
        return View::make('backend.groups.edit',
            [
                'group'       => $this->groups->findById($id),
                'permissions' => Config::get('permissions')
            ]
        );
    }

    public function update($id = null)
    {
        $form = $this->groups->getForm();

        if ( ! $form->isValid()) {
            return $this->redirectBack(['errors' => $form->getErrors()]);
        }

        $group = $this->groups->findById($id);
        $group->fill( Input::only('name'));

        if ( ! $group->save()) {
            return $this->redirectBack(['error' => 'There was a problem saving that form']);
        }

        return $this->redirectToRoute('admin.groups.edit', ['id' => $group->id])
            ->with('success', 'Group has been updated successfully');
    }
}
