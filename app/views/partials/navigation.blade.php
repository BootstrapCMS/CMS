<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            </button>
            <a class="brand" href="{{ URL::route('pages.show', array('pages' => 'home')) }}">{{ Config::get('cms.name') }}</a>
            <div class="nav-collapse collapse">

                <ul class="nav">
                    <li{{ ((Request::is('pages/'.$nav_pages[0]['slug']) || Request::is('pages/'.$nav_pages[0]['slug'].'/edit')) ? ' class="active"' : '') }}>
                        <a href="{{ URL::route('pages.show', array('pages' => $nav_pages[0]['slug'])) }}">
                            {{ ((!$nav_pages[0]['icon'] == '') ? '<i class="'.$nav_pages[0]['icon'].' icon-white"></i> ' : '') }}{{ $nav_pages[0]['title'] }}
                        </a>
                    </li>
                    @if (Config::get('cms.blogging'))
                        <li{{ ((Request::is('blog') || Request::is('blog/*')) ? ' class="active"' : '') }}>
                            <a href="{{ URL::route('blog') }}">
                                <i class="icon-book"></i> Blog
                            </a>
                        </li>
                    @endif
                    @if (Config::get('cms.events'))
                        <li{{ ((Request::is('events') || Request::is('events/*')) ? ' class="active"' : '') }}>
                            <a href="{{ URL::route('events.index') }}">
                                <i class="icon-calendar"></i> Events
                            </a>
                        </li>
                    @endif
                    <?php unset($nav_pages[0]); ?>
                    @foreach($nav_pages as $item)
                        <li{{ ((Request::is('pages/'.$item['slug']) || Request::is('pages/'.$item['slug'].'/edit')) ? ' class="active"' : '') }}>
                            <a href="{{ URL::route('pages.show', array('pages' => $item['slug'])) }}">
                                {{ ((!$item['icon'] == '') ? '<i class="'.$item['icon'].' icon-white"></i> ' : '') }}{{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <ul class="nav pull-right">
                    @if (Sentry::check())
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{ Sentry::getUser()->email }} <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ URL::route('account.profile') }}">
                                        <i class="icon-cog"></i> View Profile
                                    </a>
                                </li>
                                @if (Sentry::getUser()->hasAccess('admin'))
                                    <li>
                                        <a href="{{ URL::to('logviewer') }}">
                                            <i class="icon-wrench"></i> View Logs
                                        </a>
                                    </li>
                                @endif
                                @if (Sentry::getUser()->hasAccess('mod'))
                                    <li>
                                        <a href="{{ URL::route('users.index') }}">
                                            <i class="icon-user"></i> View Users
                                        </a>
                                    </li>
                                @endif
                                @if (Sentry::getUser()->hasAccess('admin'))
                                    <li>
                                        <a href="{{ URL::route('users.create') }}">
                                            <i class="icon-star"></i> Create User
                                        </a>
                                    </li>
                                @endif
                                @if (Sentry::getUser()->hasAccess('edit'))
                                    <li>
                                        <a href="{{ URL::route('pages.create') }}">
                                            <i class="icon-pencil"></i> Create Page
                                        </a>
                                    </li>
                                @endif
                                @if (Config::get('cms.blogging'))
                                    @if (Sentry::getUser()->hasAccess('blog'))
                                        <li>
                                            <a href="{{ URL::route('blog.posts.create') }}">
                                                <i class="icon-book"></i> Create Post
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @if (Config::get('cms.events'))
                                    @if (Sentry::getUser()->hasAccess('edit'))
                                        <li>
                                            <a href="{{ URL::route('events.create') }}">
                                                <i class="icon-calendar"></i> Create Event
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                <li>
                                    <a href="#">
                                        <i class="icon-envelope"></i> Contact Support
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ URL::route('account.logout') }}">
                                        <i class="icon-off"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li {{ (Request::is('account/login') ? 'class="active"' : '') }}>
                            <a href="{{ URL::route('account.login') }}">
                                Login
                            </a>
                        </li>
                        <li {{ (Request::is('account/register') ? 'class="active"' : '') }}>
                            <a href="{{ URL::route('account.register') }}">
                                Register
                            </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </div>
</div>
