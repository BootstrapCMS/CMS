<?php

/*
 * This file is part of Bootstrap CMS.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\BootstrapCMS\Facades\PageRepository;
use GrahamCampbell\Credentials\Facades\Credentials;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the page controller class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class PageController extends AbstractController
{
    /**
     * The home page path.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new instance.
     *
     * @param string $path
     *
     * @return void
     */
    public function __construct($path)
    {
        $this->path = $path;

        $this->setPermissions([
            'create'  => 'edit',
            'store'   => 'edit',
            'edit'    => 'edit',
            'update'  => 'edit',
            'destroy' => 'edit',
        ]);

        parent::__construct();
    }

    /**
     * Redirect to the homepage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::flash('', ''); // work around laravel bug if there is no session yet
        Session::reflash();

        return Redirect::to($this->path);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('pages.create');
    }

    /**
     * Store a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $input = array_merge($this->getInput(), ['user_id' => Credentials::getuser()->id]);

        $val = PageRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('pages.create')->withInput()->withErrors($val->errors());
        }

        $page = PageRepository::create($input);

        // write flash message and redirect
        return Redirect::route('pages.show', ['pages' => $page->slug])
            ->with('success', 'Your page has been created successfully.');
    }

    /**
     * Show the specified page.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $page = PageRepository::find($slug);
        $this->checkPage($page, $slug);

        return View::make('pages.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param string $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $page = PageRepository::find($slug);
        $this->checkPage($page, $slug);

        return View::make('pages.edit', ['page' => $page]);
    }

    /**
     * Update an existing page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug)
    {
        $input = $this->getInput();

        if (empty($input['css'])) {
            $input['css'] = '';
        }

        if (empty($input['js'])) {
            $input['js'] = '';
        }

        $val = PageRepository::validate($input, array_keys($input));
        if ($val->fails()) {
            return Redirect::route('pages.edit', ['pages' => $slug])->withInput()->withErrors($val->errors());
        }

        $page = PageRepository::find($slug);
        $this->checkPage($page, $slug);

        $checkupdate = $this->checkUpdate($input, $slug);
        if ($checkupdate) {
            return $checkupdate;
        }

        $page->update($input);

        // write flash message and redirect
        return Redirect::route('pages.show', ['pages' => $page->slug])
            ->with('success', 'Your page has been updated successfully.');
    }

    /**
     * Delete an existing page.
     *
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $page = PageRepository::find($slug);
        $this->checkPage($page, $slug);

        try {
            $page->delete();
        } catch (\Exception $e) {
            return Redirect::route('pages.show', ['pages' => $page->slug])
                ->with('error', 'You cannot delete this page.');
        }

        // write flash message and redirect
        return Redirect::to($this->path)->with('success', 'Your page has been deleted successfully.');
    }

    /**
     * Get the user input.
     *
     * @return string[]
     */
    protected function getInput()
    {
        return [
            'title'      => Binput::get('title'),
            'nav_title'  => Binput::get('nav_title'),
            'slug'       => Binput::get('slug'),
            'body'       => Binput::get('body', null, true, false), // no xss protection please
            'css'        => Binput::get('css', null, true, false), // no xss protection please
            'js'         => Binput::get('js', null, true, false), // no xss protection please
            'show_title' => (Binput::get('show_title') == 'on'),
            'show_nav'   => (Binput::get('show_nav') == 'on'),
            'icon'       => Binput::get('icon'),
        ];
    }

    /**
     * Check the page model.
     *
     * @param mixed  $page
     * @param string $slug
     *
     * @throws \Exception
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     *
     * @return \Illuminate\Http\Response
     */
    protected function checkPage($page, $slug)
    {
        if (!$page) {
            if ($slug == 'home') {
                throw new \Exception('The Homepage Is Missing');
            }

            throw new NotFoundHttpException('Page Not Found');
        }
    }

    /**
     * Check the update input.
     *
     * @param string[] $input
     * @param string   $slug
     *
     * @return \Illuminate\Http\Response
     */
    protected function checkUpdate(array $input, $slug)
    {
        if ($slug == 'home') {
            if ($slug != $input['slug']) {
                return Redirect::route('pages.edit', ['pages' => $slug])->withInput()
                    ->with('error', 'You cannot change the homepage slug.');
            }

            if ($input['show_nav'] == false) {
                return Redirect::route('pages.edit', ['pages' => $slug])->withInput()
                    ->with('error', 'The homepage must remain on the navigation bar.');
            }
        }
    }
}
