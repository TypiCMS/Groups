<?php
namespace TypiCMS\Modules\Groups\Providers;

use Config;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'TypiCMS\Modules\Groups\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('groups', 'TypiCMS\Modules\Groups\Models\Group');
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function($router) {

            /**
             * Front office routes
             */
            $routes = app('TypiCMS.routes');
            foreach (Config::get('translatable.locales') as $lang) {
                if (isset($routes['groups'][$lang])) {
                    $uri = $routes['groups'][$lang];
                } else {
                    $uri = 'groups';
                    if (Config::get('app.fallback_locale') != $lang || config('typicms.main_locale_in_url')) {
                        $uri = $lang . '/' . $uri;
                    }
                }
                $router->get($uri, array('as' => $lang.'.groups', 'uses' => 'PublicController@index'));
                $router->get($uri.'/{slug}', array('as' => $lang.'.groups.slug', 'uses' => 'PublicController@show'));
            }

            /**
             * Admin routes
             */
            $router->resource('admin/groups', 'AdminController');

            /**
             * API routes
             */
            $router->resource('api/groups', 'ApiController');
        });
    }

}
