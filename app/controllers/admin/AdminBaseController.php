<?php namespace App\Controllers\Admin;

use Illuminate\Support\Collection;
use BaseController;
use stdClass;
use Sentry;
use Input;
use Menu;
use View;



/**
 * Class AdminArticleController
 * @package App\Controllers\Admin
 */
class AdminBaseController extends BaseController {

    /**
     * @var /Menu
     */
    protected $menu;

    /**
     * The logged in user
     * @var \Cartalyst\Sentry\Users\UserInterface|null
     */
    protected $user = null;

    public function __construct()
    {
        $this->user = Sentry::getUser();

        // Apply the admin auth filter
        // $this->beforeFilter('admin-auth');

        Menu::handler('main')->hydrate(
            function()
            {
                return array(
                    [
                        'id'   => 1,
                        'url'  => route('admin.dashboard'),
                        'name' => '<i class="glyphicon glyphicon-dashboard"></i> Dashboard',
                        'as'   => 'dashboard'
                    ],
                    [
                        'id'   => 2,
                        'url'  =>route('admin.articles.index'),
                        'name' => '<i class="glyphicon glyphicon-file"></i> Articles',
                        'as'   => 'articles'
                    ],
                    [
                        'id'   => 3,
                        'url'  => route('admin.media.index'),
                        'name' => '<i class="glyphicon glyphicon-picture"></i> Media',
                        'as'   => 'media'
                    ],
                    [
                        'id'   => 4,
                        'url'  => route('admin.taxons.index'),
                        'name' => '<i class="glyphicon glyphicon-tag"></i> Taxons',
                        'as'   => 'taxons'
                    ],
                    [
                        'id'   => 5,
                        'url'  => route('admin.users.index'),
                        'name' => '<i class="glyphicon glyphicon-user"></i> Users',
                        'as'   => 'users'
                    ],
                    [
                        'id'   => 6,
                        'url'  => '#',
                        'name' => '<i class="glyphicon glyphicon-cutlery"></i> Tools',
                        'as'   => 'tools'
                    ]
                );
            },
            function($children, $item)
            {
                $children->add($item['url'], $item['name'], Menu::items($item['as']));
            }
        )->addClass('nav nav-sidebar');


        Menu::getItemList('main')->find('users')->add(
            route('admin.users.create'),
            'New user',
            null
        );

        Menu::getItemList('main')->find('users')->add(
            '#',
            'User Log',
            null
        );

        Menu::getItemList('main')->find('users')->add(
            route('admin.permissions.index'),
            'Permissions',
            null
        );

        Menu::getItemList('main')->find('articles')->add(
            route('admin.articles.create'),
            'New article',
            null
        );

        View::composer('backend.partials.profile', function($view)
            {
                $view->with('user', Sentry::getUser());
            });

        parent::__construct();
    }

    /**
     * Encodes the permissions so that they are form friendly.
     *
     * @param array $allPermissions
     * @param bool $removeSuperUser
     * @return void
     */
    protected function encodeAllPermissions(array &$allPermissions, $removeSuperUser = false)
    {
        foreach ($allPermissions as $area => &$permissions)
        {
            foreach ($permissions as $index => &$permission)
            {
                if ($removeSuperUser == true and $permission['permission'] == 'superuser')
                {
                    unset($permissions[$index]);
                    continue;
                }

                $permission['can_inherit'] = ($permission['permission'] != 'superuser');
                $permission['permission']  = base64_encode($permission['permission']);
            }

            // If we removed a super user permission and there are
            // none left, let's remove the group
            if ($removeSuperUser == true and empty($permissions))
            {
                unset($allPermissions[$area]);
            }
        }
    }

    /**
     * Encodes user permissions to match that of the encoded "all"
     * permissions above.
     *
     * @param  array  $permissions
     * @return void
     */
    protected function encodePermissions(array &$permissions)
    {
        $encodedPermissions = array();

        foreach ($permissions as $permission => $access)
        {
            $encodedPermissions[base64_encode($permission)] = $access;
        }

        $permissions = $encodedPermissions;
    }

    /**
     * Decodes user permissions to match that of the encoded "all"
     * permissions above.
     *
     * @param  array  $permissions
     * @return void
     */
    protected function decodePermissions(array &$permissions)
    {
        $decodedPermissions = array();

        foreach ($permissions as $permission => $access)
        {
            $decodedPermissions[base64_decode($permission)] = $access;
        }

        $permissions = $decodedPermissions;
    }

    /**
     * Update Permissions GET params
     *
     * @param array $default
     */
    protected function setPermissionsFromInput( array $default = [] )
    {
        $permissions = Input::get('permissions', $default);
        $this->decodePermissions($permissions);
        app('request')->request->set('permissions', $permissions);
    }
}


