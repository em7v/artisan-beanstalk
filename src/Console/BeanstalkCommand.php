<?php

namespace Friday14\Beanstalk\Console;

use Friday14\Beanstalk\Queue\BeanstalkWorker;
use Illuminate\Queue\Console\WorkCommand;

class BeanstalkCommand extends WorkCommand
{
    protected $signature = 'queue:beanstalk
                            {connection? : The name of the queue connection to work}
                            {--queue= : The names of the queues to work}
                            {--daemon : Run the worker in daemon mode (Deprecated)}
                            {--once : Only process the next job on the queue}
                            {--delay=0 : Amount of time to delay failed jobs}
                            {--force : Force the worker to run even in maintenance mode}
                            {--memory=128 : The memory limit in megabytes}
                            {--sleep=3 : Number of seconds to sleep when no job is available}
                            {--timeout=60 : The number of seconds a child process can run}
                            {--tries=0 : Number of times to attempt a job before logging it failed}';
    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        $worker = app('queue.beanstalk.worker');
        parent::__construct($worker);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fire();
    }
}
