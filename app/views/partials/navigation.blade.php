<div class="navbar{{ (Config::get('theme.inverse') == true) ? ' navbar-inverse' : ''}} navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
            <a class="brand" href="{{ URL::route('pages.show', array('pages' => 'home')) }}">{{ Config::get('cms.name') }}</a>
            <div class="nav-collapse collapse">

                <div id="main-nav">
                    <ul class="nav">
                        @foreach($nav_main as $item)
                            <li{{ ($item['active'] ? ' class="active"' : '') }}>
                                <a href="{{ $item['url'] }}">
                                    {{ ((!$item['icon'] == '') ? '<i class="'.$item['icon'].' icon-white"></i> ' : '') }}{{ $item['title'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="bar-nav">
                    <ul class="nav pull-right">
                        @if (!empty($nav_bar))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {{ Sentry::getUser()->email }} <b class="caret"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach($nav_bar as $item)
                                        <li>
                                            <a href="{{ $item['url'] }}">
                                                {{ ((!$item['icon'] == '') ? '<i class="'.$item['icon'].'></i> ' : '') }}{{ $item['title'] }}
                                            </a>
                                        </li>
                                    @endforeach
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
</div>
