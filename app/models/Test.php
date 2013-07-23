<?php

class Test extends Ardent {

    protected $table = 'pages';

    protected $hidden = array();

    protected $guarded = array();

    public static $rules = array(
        'author' => 'required',
        'body' => 'required'
    );
}
