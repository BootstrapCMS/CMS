<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

/**
 * This file is part of Bootstrap CMS by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * @package    Bootstrap-CMS
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/Bootstrap-CMS
 */

use GrahamCampbell\CMSCore\Facades\JobProvider;

use Log;

abstract class BaseHandler {

    /**
     * The maximum number of tries.
     *
     * @var array
     */
    protected $maxtries = 6;

    /**
     * The current number of tries.
     *
     * @var array
     */
    protected $tries = 1;

    /**
     * The job id.
     *
     * @var int
     */
    protected $id;

    /**
     * The job task.
     *
     * @var string
     */
    protected $task;

    /**
     * The handler status.
     *
     * @var bool
     */
    private $status = true;

    /**
     * The job model.
     *
     * @var mixed
     */
    protected $model;

    /**
     * The handler job.
     *
     * @var mixed
     */
    protected $job;

     /**
     * The handler data.
     *
     * @var array
     */
    protected $data;

    /**
     * Run the job.
     *
     * @return void
     */
    abstract protected function run();

    /**
     * Initialisation for the job.
     *
     * @return void
     */
    protected function init() {}

    /**
     * Run on construction.
     *
     * @return void
     */
    protected function before() {}

    /**
     * Run after a job success.
     *
     * @return void
     */
    protected function afterSuccess() {}

    /**
     * Run after a job failure.
     *
     * @return void
     */
    protected function afterFailure() {}

    /**
     * Run after a job abortion.
     *
     * @return void
     */
    protected function afterAbortion() {}

    /**
     * Constructor. Runs the init method.
     *
     * @return void
     */
    public function __construct() {
        $this->init(); // unprotected against exceptions
    }

    /**
     * Get the handler status.
     *
     * @return bool
     */
    protected function getStatus() {
        return $this->status;
    }

    /**
     * Fire method (called by Laravel).
     *
     * @return void
     */
    public function fire($job, $data) {
        // load job details and data to the class
        $this->id = $data['model_id'];
        $this->task = get_class($this);
        $this->job = $job;
        unset($job);
        $this->data = $data;
        unset($data);
        
        // log the job start
        Log::debug($this->task.' has started execution of job '.$this->id);

        // check if there is a job model
        try {
            $this->model = JobProvider::find($this->id);
        } catch (\Exception $e) {
           $this->abort($this->task.' has aborted because the job model was inaccessible');
        }

        // if there's not model, then the job must have been cancelled
        if (!$this->model) {
            $this->abort($this->task.' has aborted because the job was marked as cancelled');
        }

        // check the model
        try {
            if ($this->model->getId() !== $this->id) {
                throw new Exception('Bad Id');
            }
            if ($this->model->getTask() !== $this->task) {
                throw new Exception('Bad Task');
            }
        } catch (\Exception $e) {
           $this->abort($this->task.' has aborted because the job model was invalid');
        }

        // increment tries
        try {
            $this->tries = $this->model->getTries() + 1;
            $this->model->tries = $this->tries;
            $this->model->save();
        } catch (\Exception $e) {
           $this->abort($this->task.' has aborted because the job model was inaccessible');
        }

        // run the before method
        if ($this->status) {
            try {
                $this->before();
            } catch (\Exception $e) {
                $this->fail($e);
            }
        }

        // run the handler
        if ($this->status) {
            try {
                $this->run();
            } catch (\Exception $e) {
                $this->fail($e);
            }
        }

        // finish up
        if ($this->status) {
            $this->success();
        }
    }

    /**
     * Success method (called on success).
     *
     * @return void
     */
    protected function success() {
        // set status to completed
        $this->status = false;

        // remove the job from the queue
        try {
            $this->job->delete(); 
        } catch (\Exception $e) {
            Log::error($e);
        }

        // remove the job from the database
        try {
            $this->model->delete(); 
        } catch (\Exception $e) {
            Log::error($e);
        }

        // run the afterSuccess method
        try {
            $this->afterSuccess();
        } catch (\Exception $e) {
            Log::error($e);
        }

        // log the success
        Log::info($this->task.' has completed successfully');
    }

    /**
     * Failure method (called on failure).
     *
     * @return void
     */
    protected function fail($exception = null) {
        // set status to completed
        $this->status = false;

        // run the afterFailure method
        try {
            $this->afterFailure();
        } catch (\Exception $e) {
            Log::error($e);
        }

        // log the error
        if ($exception) {
            Log::critical($exception);
        } else {
            Log::critical($this->task.' has failed without an exception to log');
        }

        // attempt to retry
        if (get_class($this->job) == 'Illuminate\Queue\Jobs\BeanstalkdJob') {
            // abort if we have retried too many times
            if ($this->tries >= $this->maxtries) {
                $this->abort($this->task.' has aborted after failing '.$this->tries.' times');
            } else {
                // wait x seconds, then push back to queue
                try {
                    $this->job->release(4*$this->tries);
                } catch (\Exception $e) {
                    Log::critical($e);
                    return $this->abort($this->task.' has aborted after failing to repush to the queue');
                }
            }
        } elseif (get_class($this->job) != 'Illuminate\Queue\Jobs\SyncJob') {
            // abort if we have retried too many times
            if ($this->tries >= $this->maxtries) {
                return $this->abort($this->task.' has aborted after failing '.$this->tries.' times');
            }
            // throw an exception in order to push back to queue
            throw new \Exception($this->task.' has failed with '.get_class($this->job));
        } else {
            // throw an exception to let the caller now the sync job failed
            throw new \Exception($this->task.' has failed with '.get_class($this->job));
        }
    }

    /**
     * Abortion method (called on abortion).
     *
     * @return void
     */
    protected function abort($message = null) {
        // set status to completed
        $this->status = false;

        // run the afterAbortion method
        try {
            $this->afterAbortion();
        } catch (\Exception $e) {
            Log::error($e);
        }

        // remove the job from the queue
        try {
            $this->job->delete(); 
        } catch (\Exception $e) {
            Log::error($e);
        }

        // remove the job from the database
        try {
            $this->model->delete(); 
        } catch (\Exception $e) {
            Log::error($e);
        }

        if (get_class($this->job) != 'Illuminate\Queue\Jobs\BeanstalkdJob') {
            // log the message
            if ($message) {
                Log::critical($message); 
            } else {
                Log::critical($this->task.' has aborted without a message');
            }
        } else {
            // make sure the queue knows the job aborted
            throw new Exception($this->task.' has aborted without a message');
        }
    }
}
