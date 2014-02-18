<?php
/*
|--------------------------------------------------------------------------
| Application Bindings
|--------------------------------------------------------------------------
|
| Looks like this is how to use the IoC in Laravel?
|
*/
//App::bind('Likepie\Services\ServiceInterface',  'Likepie\Services\ArticleService');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', 'uses' => 'BlogController@homepage'));

Route::group(array('prefix' => 'admin'), function(){

        Route::get('/', array( 'as' => 'admin.dashboard', 'uses' => 'App\Controllers\Admin\AdminDashboardController@index' ));

        Route::resource('users', 'App\Controllers\Admin\AdminUserController');
        Route::resource('groups', 'App\Controllers\Admin\AdminGroupController');
        Route::resource('permissions', 'App\Controllers\Admin\AdminPermissionController');
        Route::resource('media', 'App\Controllers\Admin\AdminMediaController');
        Route::resource('taxonomy', 'App\Controllers\Admin\AdminTaxonomyController');
        Route::resource('taxonomy.units', 'App\Controllers\Admin\AdminTaxonomyUnitsController');

        Route::get('articles', array('as' => 'admin.articles.index', 'uses' => 'App\Controllers\Admin\AdminBlogController@index'));
        Route::get('articles/create', array('as' => 'admin.articles.create', 'uses' => 'App\Controllers\Admin\AdminBlogController@create'));
        Route::post('articles/store', array('as' => 'admin.articles.store', 'uses' => 'App\Controllers\Admin\AdminBlogController@store'));
        Route::get('articles/{id}/edit', array('as' => 'admin.articles.edit', 'uses' => 'App\Controllers\Admin\AdminBlogController@edit'));

    });

