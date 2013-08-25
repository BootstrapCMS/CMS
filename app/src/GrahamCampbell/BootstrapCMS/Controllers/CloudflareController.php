<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Page;

use CloudFlareAPI;

class CloudflareController extends BaseController {

    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct() {
        $this->setPermissions(array(
            'getIndex'   => 'admin',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        $stats = CloudFlareAPI::api_stats();
        return $this->viewMake('cloudflare.index', array('stats' => $stats));
    }
}
