<?php

class Page extends Ardent {

    protected $table = 'pages';

    protected $hidden = array();

    protected $guarded = array('_token', 'id');

    public static $rules = array(
        'title' => 'required',
        'slug' => 'required',
        'body' => 'required',
        'author_id' => 'required'
        );

    public static $factory = array(
        'title' => 'String',
        'slug' => 'string',
        'body' => 'text',
        'author_id' => 'factory|User'
    );

    /**
     * Belongs to user.
     *
     * @return User
     */
    public function author()
    {
        return $this->belongsTo('User', 'author_id');
    }
 
    /**
     * Get formatted creation date.
     *
     * @return string
     */
    public function createdAt()
    {
        $date_obj =  $this->created_at;
 
        if (is_string($this->created_at))
            $date_obj =  DateTime::createFromFormat('Y-m-d H:i:s', $date_obj);
 
        return $date_obj->format('d/m/Y');
    }
}
