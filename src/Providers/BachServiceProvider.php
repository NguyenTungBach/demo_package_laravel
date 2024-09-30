<?php

namespace BachVendor\BachPackage\Providers;

use BachVendor\BachPackage\Console\Commands\BachCommand;
use BachVendor\BachPackage\Http\Middleware\LogCrudOperations;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class BachServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        //load view
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bachView');
        $router = $this->app['router'];
        $router->aliasMiddleware('logs.crud', LogCrudOperations::class);

        $this->commands([
            BachCommand::class
        ]);

        // Optional: Publish configuration file
        $this->publishes([
            __DIR__ . '/../config/s3logger.php' => config_path('s3logger.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //load route
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        try {
            $this->mergeConfigFrom(
                __DIR__ . '/../config/s3logger.php', 's3logger'
            );
//            $this->app->singleton('s3logger', function ($app) {
//                $projectName = config('app.name');
//                $logger = new \Monolog\Logger($projectName);
//                $handler = new S3Handler(
//                    $projectName,
//                    $app['config']->get('s3logger')
//                );
//
//                $logger->pushHandler($handler);
//                return $logger;
//            });

            $this->app->make('config')->set('logging.channels.crud', [
                'driver' => 'daily',
                'path' => storage_path('logs/crud/crud.log'),
                'level' => 'info'
            ]);
        }catch (\Exception $exception){
            Log::error($exception);
        }

    }
}
