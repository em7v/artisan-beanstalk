<?php

namespace Friday14\Beanstalk;

use Friday14\Beanstalk\Console\BeanstalkCommand;
use Friday14\Beanstalk\Queue\BeanstalkWorker;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\ServiceProvider as SProvider;

class ServiceProvider extends SProvider
{
    public function boot()
    {
        $this->registerWorker();
        $this->commands([
            BeanstalkCommand::class
        ]);
    }

    public function registerWorker()
    {
        $this->app->singleton('queue.beanstalk.worker', function () {
            return new BeanstalkWorker(
                $this->app['queue'], $this->app['events'], $this->app[ExceptionHandler::class]
            );
        });
    }
}
