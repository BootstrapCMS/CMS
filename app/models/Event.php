<?php

class Event extends BaseModel {

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

    /**
     * Belongs to user.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get the formatted date of the event.
     *
     * @return string
     */
    public function getDate(){
        return $this->_formatDate($this->date);
    }
}
