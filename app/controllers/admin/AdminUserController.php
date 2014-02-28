<?php namespace App\Controllers\Admin;

use Likepie\Accounts\UserRepository;
use View;

/**
 * Class AdminUserController
 * @package App\Controllers\Admin
 */
class AdminUserController extends AdminBaseController {

    /** @var \Likepie\Accounts\User $users */
    private $users;

    public function __construct( UserRepository $users )
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->getAllPaginated();
        return View::make('backend.users.index')
            ->with('users', $users);
    }

}
