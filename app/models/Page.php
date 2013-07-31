<?php

class Page extends BaseModel {

    protected $table = 'pages';

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
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser($columns = array('*')) {
        return $this->user()->first($columns);
    }
}
