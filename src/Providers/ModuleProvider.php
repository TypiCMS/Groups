<?php
namespace TypiCMS\Modules\Groups\Providers;

use Config;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Lang;
use TypiCMS\Modules\Groups\Repositories\SentryGroup;
use TypiCMS\Modules\Groups\Services\Form\GroupForm;
use TypiCMS\Modules\Groups\Services\Form\GroupFormLaravelValidator;
use View;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Add dirs
        View::addNamespace('groups', __DIR__ . '/../views/');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'groups');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'typicms.groups'
        );
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');
    }

    public function register()
    {

        $app = $this->app;

        /**
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Groups\Providers\RouteServiceProvider');

        /**
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Groups\Composers\SideBarViewComposer');

        $app->bind('TypiCMS\Modules\Groups\Repositories\GroupInterface', function (Application $app) {
            return new SentryGroup(
                $app['sentry']
            );
        });

        $app->bind('TypiCMS\Modules\Groups\Services\Form\GroupForm', function (Application $app) {
            return new GroupForm(
                new GroupFormLaravelValidator($app['validator']),
                $app->make('TypiCMS\Modules\Groups\Repositories\GroupInterface')
            );
        });
    }
}
