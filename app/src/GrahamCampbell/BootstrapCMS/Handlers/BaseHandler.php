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
     * The maximum number of retries.
     *
     * @var array
     */
    protected $tries = 6;

    /**
     * The handler status.
     *
     * @var bool
     */
    private $status = true;

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
        $id = $data['model_id'];
        $this->job = $job;
        unset($job);
        $this->data = $data;
        unset($data);
        
        // log the job start
        Log::debug(get_class($this).' has started execution of job '.$id);

        // check if there is a job model
        try {
            $this->model = JobProvider::find($id);
        } catch (\Exception $e) {
           $this->abort(get_class($this).' has aborted because the job model was inaccessible');
        }

        // if there's not model, then the job must have been cancelled
        if (!$this->model) {
            $this->abort(get_class($this).' has aborted because the job was marked as cancelled');
        }

        // increment tries
        try {
            $this->model->tries = $this->model->getTries() + 1;
            $this->model->save();
        } catch (\Exception $e) {
           $this->abort(get_class($this).' has aborted because the job model was inaccessible');
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

        // log the success
        Log::info(get_class($this).' has completed successfully');

        // run the afterSuccess method
        try {
            $this->afterSuccess();
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
    }

    /**
     * Failure method (called on failure).
     *
     * @return void
     */
    protected function fail($exception = null) {
        // set status to completed
        $this->status = false;

        // log the error
        if ($exception) {
            Log::error($exception);
        } else {
            Log::error(get_class($this).' has failed without an exception to log');
        }
        
        // run the afterFailure method
        try {
            $this->afterFailure();
        } catch (\Exception $e) {
            Log::error($e);
        }

        // attempt to retry
        if (get_class($this->job) == 'Illuminate\Queue\Jobs\BeanstalkdJob') {
            $tries = $this->model->getTries();
            // abort if we have retried too many times
            if ($tries >= $this->tries) {
                $this->abort(get_class($this).' has aborted after failing '.$tries.' times');
            } else {
                // wait x seconds, then push back to queue
                try {
                    $this->job->release(4*$tries);
                } catch (\Exception $e) {
                    Log::critical($e);
                    $this->abort(get_class($this).' has aborted after failing to repush to the queue');
                }
            }
        } elseif (get_class($this->job) != 'Illuminate\Queue\Jobs\SyncJob') {
            $tries = $this->model->getTries();
            // abort if we have retried too many times
            if ($tries >= $this->tries) {
                $this->abort(get_class($this).' has aborted after failing '.$tries.' times');
            }
            // throw an exception in order to push back to queue
            throw new \Exception(get_class($this).' has failed with '.get_class($this->job));
        } else {
            // throw an exception to let the caller now the sync job failed
            throw new \Exception(get_class($this).' has failed with '.get_class($this->job));
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

        // log the message
        if ($message) {
            Log::error($message); 
        } else {
            Log::error(get_class($this).' has aborted without a message');
        }

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
    }
}
