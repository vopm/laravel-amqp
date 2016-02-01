<?php namespace Bschmitt\Amqp;

use Bschmitt\Amqp\Consumer;
use Bschmitt\Amqp\Publisher;
use Illuminate\Support\ServiceProvider;

class AmqpServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Bschmitt\Amqp\Publisher', function ($app) {
            return new Publisher(config());
        });
        $this->app->singleton('Bschmitt\Amqp\Consumer', function ($app) {
            return new Consumer(config());
        });
        $this->app->bind('Amqp', 'Bschmitt\Amqp\Amqp');
        if (!class_exists('Amqp')) {
            class_alias('Bschmitt\Amqp\Facades\Amqp', 'Amqp');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['Bschmitt\Amqp\Publisher' , 'Bschmitt\Amqp\Consumer'];
    }
}
