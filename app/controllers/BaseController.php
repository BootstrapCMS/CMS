<?php

abstract class BaseController extends Controller {

    protected $page; // must be set in the extending class

    private $users  = array();
    private $edits  = array();
    private $blogs  = array();
    private $mods   = array();
    private $admins = array();

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

    protected function viewMake($view, $data = array()) {
        $data['nav_pages'] = $this->page->getNav();
        return View::make($view, $data);
    }

    protected function setPermission($action, $permission) {
        $this->{$permission.'s'}[] = $action;
    }

    protected function setPermissions($permissions) {
        foreach ($permissions as $action => $permission) {
            $this->setPermission($action, $permission);
        }
    }

    protected function getUserId() {
        if (Sentry::getUser()) {
            return Sentry::getUser()->getId();
        } else {
            return 1;
        }
    }

    /**
     * Handle missing methods with a catch all statement.
     * Used for more useful debugging and logging.
     *
     * @return Response
     */
    public function missingMethod($parameters) {
        Log::notice('Missing method exception occurred in '.get_class($this), array('parameters' => $parameters));
        return App::abort(404, 'Missing Controller Method');
    }
}
