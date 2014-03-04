<?php namespace App\Controllers\Admin;

use Illuminate\Support\Collection;
use BaseController;
use stdClass;
use Input;
use Menu;



/**
 * Class AdminArticleController
 * @package App\Controllers\Admin
 */
class AdminBaseController extends BaseController {

    /**
     * @var /Menu
     */
    protected $menu;

    public function __construct()
    {
        // Apply the admin auth filter
        // $this->beforeFilter('admin-auth');

        Menu::handler('main')->hydrate(function()
            {
                return array(

                    array(
                        'id'   => 1,
                        'url'  => route('admin.dashboard'),
                        'name' => '<i class="glyphicon glyphicon-dashboard"></i> Overview',
                        'as'   => 'admin.dashboard',
                        'children' => array()
                    ),
                    array(
                        'id'   => 2,
                        'url'  => route('admin.articles.index'),
                        'name' => '<i class="glyphicon glyphicon-dashboard"></i> Articles',
                        'as'   => 'admin.articles.index',
                        'children' => array(
                            'url' => route('admin.articles.create'),
                            'name' => 'Create New Article',
                            'as'   => 'admin.articles.create',
                        )
                    ),
                );
            },
            function($children, $item)
            {
                $children->add($item['url'], $item['name'], Menu::items($item['as']), $item['children']);
            }
        )->addClass('nav nav-sidebar');

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

    protected function setPermissionsFromInput( array $default = [] )
    {
        // Update Permissions GET params
        $permissions = Input::get('permissions', $default);
        $this->decodePermissions($permissions);
        app('request')->request->set('permissions', $permissions);
    }
}


