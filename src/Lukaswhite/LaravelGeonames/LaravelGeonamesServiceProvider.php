<?php namespace Lukaswhite\LaravelGeonames;

use Illuminate\Support\ServiceProvider;
use Lukaswhite\Geonames\Geonames;

/**
 * Class LaravelGeonamesServiceProvider
 *
 * Registers the configuration, and then places the Geonames web service
 * into the service container.
 *
 * @package Lukaswhite\LaravelGeonames
 */
class LaravelGeonamesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Merge in the config
        $configPath = __DIR__ . '/../../../resources/config/geonames.php';
        $this->mergeConfigFrom( $configPath, 'geonames' );

        // Register the package's migrations
        //$this->loadMigrationsFrom( __DIR__ . '/../../../migrations');

        // Add the Geonames service into the service container
        $this->app->singleton( 'Lukaswhite\Geonames\Geonames', function( $app ) {
            return new Geonames(
                $app[ 'config' ][ 'geonames' ][ 'username']
            );
        } );
    }

}
