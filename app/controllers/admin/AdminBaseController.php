<?php namespace App\Controllers\Admin;

use BaseController;
use Illuminate\Support\Collection;
use Menu;
use stdClass;


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



}


