<?php namespace GrahamCampbell\BootstrapCMS\Models\Interfaces;

interface IBaseModel {

    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Get created_at.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAt();

    /**
     * Get updated_at.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt();

}
