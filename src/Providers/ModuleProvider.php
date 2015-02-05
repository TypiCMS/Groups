<?php
namespace TypiCMS\Modules\Groups\Providers;

use Lang;
use View;
use Config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use TypiCMS\Modules\Groups\Repositories\SentryGroup;

// Form
use TypiCMS\Modules\Groups\Services\Form\GroupForm;
use TypiCMS\Modules\Groups\Services\Form\GroupFormLaravelValidator;

class ModuleProvider extends ServiceProvider
{

    public function boot()
    {
        // Bring in the routes
        require __DIR__ . '/../routes.php';

        // Add dirs
        View::addLocation(__DIR__ . '/../Views');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'groups');
        $this->publishes([
            __DIR__ . '/../config/' => config_path('typicms/groups'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../migrations/' => base_path('/database/migrations'),
        ], 'migrations');
    }

    public function register()
    {

        $app = $this->app;

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
