<?php

class Event extends BaseModel {

    use TraitTitleModel, TraitBodyModel;

    protected $table = 'events';

    public $rules = array(
        'title'    => 'required',
        'body'     => 'required',
        'date'     => 'required',
        'location' => 'required',
        'user_id'  => 'required',
    );

    public $factory = array(
        'title'    => 'String',
        'body'     => 'text',
        'date'     => '????',
        'location' => 'text',
        'user_id'  => 1,
    );

    public function getDate() {
        return $this->date;
    }

    public function getLocation() {
        return $this->location;
    }
}
