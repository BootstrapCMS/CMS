<?php

class Page extends BaseModel {

    protected $table = 'pages';

    public $rules = array(
        'title'      => 'required',
        'slug'       => 'required',
        'body'       => 'required',
        'show_title' => 'required',
        'show_nav'   => 'required',
        'user_id'    => 'required',
    );

    public $factory = array(
        'id'         => 1,
        'title'      => 'Page Title',
        'slug'       => 'page-title',
        'body'       => 'This is the page body!',
        'show_title' => true,
        'show_nav'   => true,
        'icon'       => '',
        'user_id'    => 1,
    );

    public function getTitle() {
        return $this->title;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getBody() {
        return $this->body;
    }

    public function getShowTitle() {
        return $this->show_title;
    }

    public function getShowNav() {
        return $this->show_nav;
    }

    public function getIcon() {
        return $this->icon;
    }

    public function getNav() {
        // TODO: caching logic
        return $this->where('show_nav', '=', true)->get(array('title', 'slug', 'icon'))->toArray();
    }

    public function findBySlug($slug, $columns = array('*')) {
        return $this->where('slug', '=', $slug)->first($columns);
    }
}
