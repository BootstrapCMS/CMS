<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use Log;

abstract class BaseHandler {

    private $status = true;
    protected function getStatus() {
        return $this->status;
    }

    protected $job;
    protected $data;

    abstract protected function run();

    protected function init() {}
    protected function before() {}
    protected function afterSuccess() {}
    protected function afterFailure() {}
    protected function afterAbortion() {}

    /**
     * Constructor.
     */
    public function __construct() {
        // unprotected against exceptions
        $this->init();
    }

    /**
     * Fire method.
     * Called by Laravel.
     */
    public function fire($job, $data) {
        // log the job start
        Log::debug(get_class($this).' has started execution');

        // load job details and data to the class
        $this->job = $job;
        $this->data = $data;

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
     * Called on success.
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
    }

    /**
     * Called on failure.
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

        // if can handle retrying
        if (get_class($this->job) == 'Illuminate\Queue\Jobs\BeanstalkdJob') {
            // abort if we have retried too many times
            if ($this->job->attempts() >= 3) {
                $this->abort(get_class($this).' has aborted after failing 3 times');
            } else {
                // wait x seconds, then push back to queue, or abort if that fails
                try {
                    $this->job->release(4*$this->job->attempts());
                } catch (\Exception $e) {
                    Log::critical($e);
                    $this->abort(get_class($this).' has aborted after failing to repush to the queue');
                }
            }
        } else {
            // throw an exception
            throw new \Exception(get_class($this).' has failed with '.get_class($this->job));
        }
    }

    /**
     * Called on abortion.
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
    }
}
