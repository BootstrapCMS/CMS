<?php namespace GrahamCampbell\BootstrapCMS\Interfaces;

interface ICacheable {

    public function flush();

    public function purge($name);

    public function refresh($name);

}
