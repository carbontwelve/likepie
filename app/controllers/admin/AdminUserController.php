<?php namespace App\Controllers\Admin;

use Likepie\Accounts\User;
use View;

/**
 * Class AdminUserController
 * @package App\Controllers\Admin
 */
class AdminUserController extends AdminBaseController {

    /** @var \Likepie\Accounts\User $users */
    private $users;

    public function __construct( User $users )
    {
        $this->users = $users;
    }

    public function index()
    {
        return View::make('backend.users.index');
    }
}
