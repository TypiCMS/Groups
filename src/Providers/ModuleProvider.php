<?php

namespace TypiCMS\Modules\Groups\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use TypiCMS\Modules\Groups\Models\Group;
use TypiCMS\Modules\Groups\Repositories\EloquentGroup;

class ModuleProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'typicms.groups'
        );

        $modules = $this->app['config']['typicms']['modules'];
        $this->app['config']->set('typicms.modules', array_merge(['groups' => []], $modules));

        $this->loadViewsFrom(__DIR__.'/../resources/views/', 'groups');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'groups');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/groups'),
        ], 'views');
        $this->publishes([
            __DIR__.'/../database' => base_path('database'),
        ], 'migrations');

        AliasLoader::getInstance()->alias(
            'Groups',
            'TypiCMS\Modules\Groups\Facades\Facade'
        );
    }

    public function register()
    {
        $app = $this->app;

        /*
         * Register route service provider
         */
        $app->register('TypiCMS\Modules\Groups\Providers\RouteServiceProvider');

        /*
         * Sidebar view composer
         */
        $app->view->composer('core::admin._sidebar', 'TypiCMS\Modules\Groups\Composers\SidebarViewComposer');

        $app->bind('TypiCMS\Modules\Groups\Repositories\GroupInterface', function (Application $app) {
            return new EloquentGroup(new Group());
        });
    }
}
