<?php

class Event extends BaseModel implements ITitleModel, IBodyModel, IDateModel, ILocationModel, IBelongsToUser {

    use TraitTitleModel, TraitBodyModel, TraitDateModel, TraitLocationModel, TraitBelongsToUser;

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
}
