<?php

namespace Noures\NovaCep;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class NovaCepServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->booted(function () {
            $this->routes();
        });

        $this->loadTranslations();

        Nova::serving(function (ServingNova $event) {
            $this->bootTranslations();

            Nova::script('noures-nova-cep', __DIR__.'/../dist/js/field.js');
            Nova::style('noures-nova-cep', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::prefix('noures/nova-cep')
            ->name('noures.nova-cep.')
            ->group(__DIR__ . '/../routes/api.php');
    }

     /**
     * Load package translation resources.
     *
     * @return void
     */
    protected function loadTranslations()
    {
        $this->loadJSONTranslationsFrom(__DIR__ . '/../resources/lang');
        $this->loadJSONTranslationsFrom(resource_path('lang/vendor/noures/nova-cep'));
    }

    /**
     * Bootstraps current application locale translations to Nova.
     *
     * @return void
     */
    protected function bootTranslations()
    {
        $locale = $this->app->getLocale();

        Nova::translations(__DIR__ . "/../resources/lang/{$locale}.json");
        Nova::translations(resource_path("lang/vendor/noures/nova-cep/$locale.json"));
    }
}
