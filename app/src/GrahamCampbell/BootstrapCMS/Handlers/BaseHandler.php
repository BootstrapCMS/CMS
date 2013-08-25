<?php namespace GrahamCampbell\BootstrapCMS\Handlers;

use Log;

abstract class BaseHandler {

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
    }
}
