<?php

class PageController extends BaseController {

    protected $page;

    /**
     * Load the injected models.
     * Setup access permissions.
     */
    public function __construct(Page $page) {
        $this->page = $page;

        $this->edits[] = 'create';
        $this->edits[] = 'store';
        $this->edits[] = 'edit';
        $this->edits[] = 'update';
        $this->edits[] = 'destroy';

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        Session::flash('', ''); // work around laravel bug
        Session::reflash();
        Log::info('Redirecting from pages to the home page');
        return Redirect::route('pages.show', array('pages' => 'home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return $this->viewMake('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $input = array(
            'title'      => Binput::get('title'),
            'slug'       => urlencode(strtolower(str_replace(' ', '-', Binput::get('title')))),
            'body'       => Input::get('body'), // use standard input method
            'show_title' => (Binput::get('show_title') == 'on'),
            'show_nav'   => (Binput::get('show_nav') == 'on'),
            'icon'       => Binput::get('icon'),
            'user_id'    => $this->getUserId(),
        );

        $rules = $this->page->rules;

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            return Redirect::route('pages.create')->withInput()->withErrors($v->errors());
        } else {
            $page = $this->page->create($input);

            Session::flash('success', 'Your page has been created successfully.');
            return Redirect::route('pages.show', array('pages' => $page->getSlug()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($slug) {
        $page = $this->page->findBySlug($slug);

        if (!$page) {
            if ($slug == 'home') {
                App::abort(500, 'The Homepage Is Missing');
            } else {
                App::abort(404, 'Page Not Found');
            }
        }

        return $this->viewMake('pages.show', array('page' => $page));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function edit($slug) {
        $page = $this->page->findBySlug($slug);

        if (!$page) {
            if ($slug == 'home') {
                App::abort(500, 'The Homepage Is Missing');
            } else {
                App::abort(404, 'Page Not Found');
            }
        }

        return $this->viewMake('pages.edit', array('page' => $page));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function update($slug) {
        $input = array(
            'title' => Binput::get('title'),
            'slug' => urlencode(strtolower(str_replace(' ', '-', Binput::get('title')))),
            'body' => Input::get('body'), // use standard input method
            'show_title' => (Binput::get('show_title') == 'on'),
            'show_nav' => (Binput::get('show_nav') == 'on'),
            'icon' => Binput::get('icon'),
        );

        $rules = $this->page->rules;
        unset($rules['user_id']);

        $v = Validator::make($input, $rules);
        if ($v->fails()) {
            return Redirect::route('pages.edit', array('pages' => $slug))->withInput()->withErrors($v->errors());
        } else {
            $page = $this->page->findBySlug($slug);

            if (!$page) {
                if ($slug == 'home') {
                    App::abort(500, 'The Homepage Is Missing');
                } else {
                    App::abort(404, 'Page Not Found');
                }
            }

            if ($slug == 'home') {
                if ($slug != $input['slug']) {
                    Session::flash('error', 'You cannot rename the homepage.');
                    return Redirect::route('pages.edit', array('pages' => $slug))->withInput();
                }
                if ($input['show_nav'] == false) {
                    Session::flash('error', 'The homepage must be on the navigation bar.');
                    return Redirect::route('pages.edit', array('pages' => $slug))->withInput();
                }
            }

            $page->update($input);
            
            Session::flash('success', 'Your page has been updated successfully.');
            return Redirect::route('pages.show', array('pages' => $page->getSlug()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function destroy($slug) {
        $page = $this->page->findBySlug($slug);

        if (!$page) {
            if ($slug == 'home') {
                App::abort(500, 'The Homepage Is Missing');
            } else {
                App::abort(404, 'Page Not Found');
            }
        }

        if ($slug == 'home') {
            Session::flash('error', 'You cannot delete the homepage.');
            return Redirect::route('pages.index');
        }

        $page->delete();

        Session::flash('success', 'Your page has been deleted successfully.');
        return Redirect::route('pages.index');
    }
}
