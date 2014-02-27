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

Route::get('/', array('as' => 'home', 'uses' => 'ArticleController@homepage'));
Route::get('/article/{slug}', array('as' => 'article', 'uses' => 'ArticleController@viewBySlug'));

Route::group(array('prefix' => 'admin'), function(){

        Route::get('/', array( 'as' => 'admin.dashboard', 'uses' => 'App\Controllers\Admin\AdminDashboardController@index' ));

        Route::resource('users', 'App\Controllers\Admin\AdminUserController');
        Route::resource('groups', 'App\Controllers\Admin\AdminGroupController');
        Route::resource('permissions', 'App\Controllers\Admin\AdminPermissionController');
        Route::resource('media', 'App\Controllers\Admin\AdminMediaController');
        Route::resource('taxonomy', 'App\Controllers\Admin\AdminTaxonomyController');
        Route::get('taxonomy/{id}/delete', [ 'as' => 'admin.taxonomy.delete', 'uses' => 'App\Controllers\Admin\AdminTaxonomyController@destroy'] );
        Route::resource('taxons', 'App\Controllers\Admin\AdminTaxonController');
        Route::get('taxons/autocomplete', [ 'as' => 'admin.taxons.autocomplete', 'uses' => 'App\Controllers\Admin\AdminTaxonController@autocomplete'] );
        Route::get('taxons/{id}/delete', [ 'as' => 'admin.taxons.delete', 'uses' => 'App\Controllers\Admin\AdminTaxonController@destroy'] );
        Route::resource('articles', 'App\Controllers\Admin\AdminArticleController');

    });

Route::group(array('prefix' => 'auth'), function(){

        Route::get('/login', array('as' => 'auth.login', 'uses' => 'App\Controllers\Auth\UserSessionController@create' ));
        Route::get('/logout', array('as' => 'auth.login', 'uses' => 'App\Controllers\Auth\UserSessionController@destroy' ));

    });
