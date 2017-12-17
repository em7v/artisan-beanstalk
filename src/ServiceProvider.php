<?php

namespace Friday14\Beanstalk;

use Friday14\Beanstalk\Console\BeanstalkCommand;
use Illuminate\Support\ServiceProvider as SProvider;

class ServiceProvider extends SProvider
{
    public function register()
    {
        $this->commands([
            BeanstalkCommand::class
        ]);
    }
}