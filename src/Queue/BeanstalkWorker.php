<?php

namespace Friday14\Beanstalk\Queue;

use Illuminate\Queue\Worker;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class BeanstalkWorker extends Worker
{
    /**
     * Get the next job from the queue connection.
     *
     * @param  \Illuminate\Contracts\Queue\Queue $connection
     * @param  string                            $queue
     *
     * @return \Illuminate\Contracts\Queue\Job|null
     * @throws \Exception
     */
    protected function getNextJob($connection, $queue)
    {
        if (!method_exists($connection, 'getPheanstalk')) {
            throw new \Exception('Works only with Beanstalk');
        }

        $tubes = $connection->getPheanstalk()->listTubes();

        foreach (explode(',', $queue) as $rule) {
            $queues[] = preg_grep('/' . $rule . '$/i', $tubes);
        }
        $queues = array_flatten($queues);


        try {
            foreach ($queues as $q) {
                if ( ! is_null($job = $connection->pop($q))) {
                    return $job;
                }
            }
        } catch (\Exception $e) {
            $this->exceptions->report($e);

            $this->stopWorkerIfLostConnection($e);
        } catch (\Throwable $e) {
            $this->exceptions->report($e = new FatalThrowableError($e));

            $this->stopWorkerIfLostConnection($e);
        }
    }
}