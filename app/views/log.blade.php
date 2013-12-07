@extends(Config::get('views.default', 'layouts.default'))

<?php $name = 'Log Viewer'; ?>

@section('title')
{{ ucwords(str_replace('-', ' ', $name)) }}
@stop

@section('content')
<div class="container" id="main-container">
    <div class="row">
        <div class="col-lg-12">
            <ul class="nav nav-pills">
                <li class="{{ Request::segment(6) === null || Request::segment(6) === 'all' ? 'active' : ''}}"><a href="{{ Request::root() }}/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/all' }}">All</a></li>
                @foreach ($levels as $level)
                    <li class="{{ Request::segment(6) === $level ? 'active' : '' }}"><a href="{{ Request::root() }}/{{ $url . '/' . $path . '/' . $sapi_plain . '/' . $date . '/' . $level }}">{{ ucfirst(Lang::get('logviewer::logviewer.levels.' . $level)) }}</a></li>
                @endforeach
                @if(!$empty)
                <li class="pull-right">
                    <button data-toggle="modal" data-target="#delete-modal" id="btn-delete" type="button" class="btn btn-danger">Delete current log</button>
                </li>
                @endif
            </ul>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
        @if($logs)
        <div class="panel-group" id="accordion">
            @foreach ($logs as $type => $files)
            <?php $count = count($files['logs']) ?>
                @foreach ($files['logs'] as $app => $file)
                    @if(!empty($file))
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ lcfirst($files['sapi']) }}">
                                    {{ ($count > 1 ? $app . ' - ' . $files['sapi'] : $files['sapi']) }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-{{ lcfirst($files['sapi']) }}" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav nav-list">
                                        @foreach ($file as $f)
                                             <li class="list-group-item">
                                                <a href="{{ Request::root() }}/{{ $url . '/' . $app . '/' . $type . '/' . $f }} ">{{ $f }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endforeach
        </div>
        @endif
        </div>
        <div class="col-lg-10">
            <div class="{{ ! $has_messages ? ' hidden' : '' }}">
                <div class="col-lg-12" id="messages">
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
                <div class="col-lg-12">
                    {{ $paginator->links() }}
                    <div id="log" class="well">
                        @if(!$empty && !empty($log))
                            <?php $c = 1; ?>
                            @foreach($log as $l)
                                <div class="alert">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="log log-{{ $l['level'] }}">
                                                <h4 class="panel-title">
                                                    @if($l['stack'] !== "\n")
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $c }}" >
                                                    @endif
                                                    {{ $l['header'] }}
                                                    </a>
                                                </h4>
                                            </div>
                                            @if($l['stack'] !== "\n")
                                            <div id="collapse-{{ $c }}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <pre>
                                                        {{ $l['stack'] }}
                                                    </pre>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <?php $c++; ?>
                            @endforeach
                        @elseif(!$empty && empty($log))
                            <div class="alert alert-info">
                                {{ Lang::get('logviewer::logviewer.empty_file', array('sapi' => $sapi, 'date' => $date)) }}
                            </div>
                        @else
                            <div class="alert alert-info">
                                {{ Lang::get('logviewer::logviewer.no_log', array('sapi' => $sapi, 'date' => $date)) }}
                            </div>
                        @endif
                    </div>
                    {{ $paginator->links() }}
                </div>
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
@stop

@section('css')
{{ Asset::styles('logviewer') }}
@endsection
