<?php

abstract class BaseController extends Controller {

    protected $page; // must be set in the extending class

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

    public function viewMake($view, $data = array()) {
        $data['nav_pages'] = $this->page->getNav();
        return View::make($view, $data);
    }

    public function getUserId() {
        if (Sentry::getUser()) {
            return Sentry::getUser()->getId();
        } else {
            return 1;
        }
    }
}
