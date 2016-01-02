<?php

namespace TypiCMS\Modules\Groups\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Groups\Http\Controllers';

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function (Router $router) {

            /*
             * Admin routes
             */
            $router->get('admin/groups', ['as' => 'admin.groups.index', 'uses' => 'AdminController@index']);
            $router->get('admin/groups/create', ['as' => 'admin.groups.create', 'uses' => 'AdminController@create']);
            $router->get('admin/groups/{group}/edit', ['as' => 'admin.groups.edit', 'uses' => 'AdminController@edit']);
            $router->post('admin/groups', ['as' => 'admin.groups.store', 'uses' => 'AdminController@store']);
            $router->put('admin/groups/{group}', ['as' => 'admin.groups.update', 'uses' => 'AdminController@update']);

            /*
             * API routes
             */
            $router->get('api/groups', ['as' => 'api.groups.index', 'uses' => 'ApiController@index']);
            $router->put('api/groups/{group}', ['as' => 'api.groups.update', 'uses' => 'ApiController@update']);
            $router->delete('api/groups/{group}', ['as' => 'api.groups.destroy', 'uses' => 'ApiController@destroy']);
        });
    }
}
