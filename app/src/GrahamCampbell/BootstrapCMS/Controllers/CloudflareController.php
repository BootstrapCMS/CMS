<?php namespace GrahamCampbell\BootstrapCMS\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Page;

use CloudFlareAPI;

class CloudflareController extends BaseController {

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page) {
        $this->page  = $page;

        $this->setPermissions(array(
            'getIndex'   => 'admin',
        ));

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex() {
        $stats = CloudFlareAPI::api_stats();
        return $this->viewMake('cloudflare.index', array('stats' => $stats));
    }

}
