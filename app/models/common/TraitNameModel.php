<?php

trait TraitNameModel {

    public function getFirstName() {
        return $this->first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function getName() {
        return $this->first_name.' '.$this->last_name;
    }
}
