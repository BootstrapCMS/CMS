<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use App;
use Controller;
use Log;
use View;

use Sentry;

use Navigation;

abstract class BaseController extends Controller {

    /**
     * A list of methods protected by user permissions.
     *
     * @var array
     */
    private $users  = array();

    /**
     * A list of methods protected by edit permissions.
     *
     * @var array
     */
    private $edits  = array();

    /**
     * A list of methods protected by blog permissions.
     *
     * @var array
     */
    private $blogs  = array();

    /**
     * A list of methods protected by mod permissions.
     *
     * @var array
     */
    private $mods   = array();

    /**
     * A list of methods protected by admin permissions.
     *
     * @var array
     */
    private $admins = array();

    /**
     * Constructor (setup protection and permissions).
     *
     * @return void
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
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Make a page view.
     *
     * @return \Illuminate\View\View
     */
    protected function viewMake($view, $data = array()) {
        // append the navigation data to the view data
        $data['nav_pages'] = Navigation::get();
        //return var_dump($data['nav_pages']);
        return View::make($view, $data);
    }

    /**
     * Set the permission.
     *
     * @pram  string  $action
     * @pram  string  $permission
     * @return void
     */
    protected function setPermission($action, $permission) {
        $this->{$permission.'s'}[] = $action;
    }

    /**
     * Set the permissions.
     *
     * @pram  array  $permissions
     * @return void
     */
    protected function setPermissions($permissions) {
        foreach ($permissions as $action => $permission) {
            $this->setPermission($action, $permission);
        }
    }

    /**
     * Set the user id.
     *
     * @return int
     */
    protected function getUserId() {
        if (Sentry::getUser()) {
            return Sentry::getUser()->getId();
        } else {
            return 1;
        }
    }

    /**
     * Handle missing methods with a catch all statement.
     *
     * @return \Illuminate\Http\Response
     */
    public function missingMethod($parameters) {
        Log::notice('Missing method exception occurred in '.get_class($this), array('parameters' => $parameters));
        return App::abort(404, 'Missing Controller Method');
    }
}
