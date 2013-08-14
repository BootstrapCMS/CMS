<?php namespace GrahamCampbell\BootstrapCMS\Models;

class Event extends BaseModel implements Interfaces\ITitleModel, Interfaces\IBodyModel, Interfaces\IDateModel, Interfaces\ILocationModel, Relations\Interfaces\IBelongsToUser {

    use Common\TraitTitleModel, Common\TraitBodyModel, Common\TraitDateModel, Common\TraitLocationModel, Relations\Common\TraitBelongsToUser;

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
