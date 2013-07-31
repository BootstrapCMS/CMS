<?php

class BaseController extends Controller {

    protected $users = array();
    protected $edits = array();
    protected $blogs = array();
    protected $mods = array();
    protected $admins = array();

    /**
     * Setup scrf protection.
     * Setup brute force protection.
     * Setup access permissions.
     */
    public function __construct() {
        $this->beforeFilter('csrf', array('on' => 'post'));

        Sentry::getThrottleProvider()->enable();

        $this->beforeFilter('auth:user', array('only' => $this->users));
        $this->beforeFilter('auth:edit', array('only' => $this->edits));
        $this->beforeFilter('auth:blog', array('only' => $this->blogs));
        $this->beforeFilter('auth:mod', array('only' => $this->mods));
        $this->beforeFilter('auth:admin', array('only' => $this->admins));
    }

    /**
     * Setup the layout used by the controller.
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Handle missing methods with a catch all statement.
     * Used for more useful debugging and logging.
     *
     * @return Response
     */
    public function missingMethod($parameters) {
        return App::abort(404, 'Missing Controller Method');
    }
}
