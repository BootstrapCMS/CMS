<?php

class ConfigController extends BaseController {

    /**
     * Constructor
     */
    public function __construct() {
        $this->admins[] = 'index';
        $this->admins[] = 'show';
        $this->admins[] = 'edit';
        $this->admins[] = 'update';
        $this->admins[] = 'destroy';
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return 'config index';
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return Response
     */
    public function show($name) {
        return 'config show '.$name;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $name
     * @return Response
     */
    public function edit($name) {
        return 'config edit '.$name;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $name
     * @return Response
     */
    public function update($name) {
        return 'config update '.$name;
    }
}
