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
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex() {
        return $this->viewMake('cloudflare.index');
    }

    /**
     * Display a data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData() {
        $stats = CloudFlareAPI::api_stats();
        $data = $stats['response']['result']['objs']['0']['trafficBreakdown'];
        return $this->viewMake('cloudflare.data', array('data' => $data));
    }
}
