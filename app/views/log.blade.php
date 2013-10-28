<!DOCTYPE html>
<html lang="en-GB">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ Lang::get('logviewer::logviewer.title') }}</title>
    @include('partials.header')
    {{ Basset::show('logviewer.css') }}
</head>

<body>
<div id="wrap">
<div class="navbar{{ (Config::get('theme.inverse') == true) ? ' navbar-inverse' : ''}} navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('pages.show', array('pages' => 'home')) }}">Log Viewer</a>
    </div>
    <div class="collapse navbar-collapse">
        <div id="main-nav">
            <ul class="nav navbar-nav">
                {{ HTML::nav_item($url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/all', ucfirst(Lang::get('logviewer::logviewer.levels.all'))) }}
                @foreach ($levels as $level)
                    {{ HTML::nav_item($url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/' . $level, ucfirst(Lang::get('logviewer::logviewer.levels.' . $level))) }}
                @endforeach
            </ul>
        </div>
        </div>
        <div id="bar-nav">
            <ul class="nav navbar-nav navbar-right">
                {{ HTML::link(URL::route('pages.show', array('pages' => 'home')), 'Return To Site', array('class' => 'btn btn-info')) }} {{ HTML::link('#delete_modal', Lang::get('logviewer::logviewer.delete.btn'), array('class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#delete_modal')) }}
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-2 col-sm-3">
        <div id="nav" class="well">
            <ul class="nav nav-list">
                @if ($logs)
                    @foreach ($logs as $type => $files)
                        @if ( ! empty($files['logs']))
                            <?php $count = count($files['logs']) ?>
                            @foreach ($files['logs'] as $app => $file)
                                @if ( ! empty($file))
                                    <li class="nav-header">{{ ($count > 1 ? $app . ' - ' . $files['sapi'] : $files['sapi']) }}</li>
                                    <ul class="nav nav-list">
                                        @foreach ($file as $f)
                                            {{ HTML::decode(HTML::nav_item($url . '/' . $app . '/' . $type . '/' . $f, $f)) }}
                                        @endforeach
                                    </ul>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <div class="col-md-10 col-sm-9">
        <div class="row{{ ! $has_messages ? ' hidden' : '' }}">
            <div class="col-xs-12" id="messages">
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('info'))
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ Session::get('info') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {{ $paginator->links() }}
                <div id="log" class="well">
                    @if ( ! $empty && ! empty($log))
                        @foreach ($log as $l)
                            @if (strlen($l['stack']) > 1)
                                <div class="alert alert-block alert-{{ $l['level'] }}">
                                    <span title="Click to toggle stack trace" class="toggle-stack"><i class="fa fa-expand-o"></i></span>
                                    <span class="stack-header">{{ $l['header'] }}</span>
                                    <pre class="stack-trace">{{ $l['stack'] }}</pre>
                                </div>
                            @else
                                <div class="alert alert-block alert-{{ $l['level'] }}">
                                    <span class="toggle-stack">&nbsp;&nbsp;</span>
                                    <span class="stack-header">{{ $l['header'] }}</span>
                                </div>
                            @endif
                        @endforeach
                    @elseif ( ! $empty && empty($log))
                        <div class="alert alert-block">
                            {{ Lang::get('logviewer::logviewer.empty_file', array('sapi' => $sapi, 'date' => $date)) }}
                        </div>
                    @else
                        <div class="alert alert-block">
                            {{ Lang::get('logviewer::logviewer.no_log', array('sapi' => $sapi, 'date' => $date)) }}
                        </div>
                    @endif
                </div>
                {{ $paginator->links() }}
            </div>
        </div>
    </div>

</div>

<div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Are you sure?</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete this log! This process cannot be undone.</p>
                <p>Are you sure you wish to continue?</p>
            </div>
            <div class="modal-footer">
                {{ HTML::link($url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/delete', Lang::get('logviewer::logviewer.delete.modal.btn.yes'), array('class' => 'btn btn-success')) }}
                <button class="btn btn-danger" data-dismiss="modal">{{ Lang::get('logviewer::logviewer.delete.modal.btn.no') }}</button>
            </div>
        </div>
    </div>
</div>

{{ HTMLMin::render($__env->make('partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render()) }}
{{ Basset::show('logviewer.js') }}
</body>
</html>
