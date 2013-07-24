<?php

class Event extends BaseModel {

    protected $table = 'events';

    public static $rules = array(
        'title' => 'required',
        'slug' => 'required',
        'body' => 'required',
        'user_id' => 'required'
        );

    public static $factory = array(
        'title' => 'String',
        'slug' => 'string',
        'body' => 'text',
        'user_id' => 'factory|User'
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
}
