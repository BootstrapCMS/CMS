</div></div>

<div id="footer">
    <div class="container hidden-xs">
        <div class="row">
            <div class="col-xs-8">
                <p class="text-muted credit">
                    © <a href="https://github.com/GrahamCampbell">{{ Config::get('cms.author') }}</a> 2014. All rights reserved.
                </p>
            </div>
            <div class="col-xs-4">
                <p class="text-muted credit pull-right">
                    Generated in {{ round((microtime(1) - LARAVEL_START), 4) }} sec.
                </p>
            </div>
        </div>
    </div>
    <div class="container visible-xs">
        <p class="text-muted credit">
            © <a href="https://github.com/GrahamCampbell">{{ Config::get('cms.author') }}</a> 2014. All rights reserved.
        </p>
    </div>
</div>

{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.4.1/jquery.timeago.min.js') !!}
{!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/js/bootstrap.min.js') !!}
{!! Asset::scripts('main') !!}
@section('js')
@show
@if (Config::get('analytics.google'))
    @include('partials.analytics')
@endif
