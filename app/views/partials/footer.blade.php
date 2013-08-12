<div id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span12">
                <div class="span8">
                    <p class="muted credit">
                        © <a href="https://github.com/GrahamCampbell">Graham Campbell</a> 2013. All rights reserved.
                    </p>
                </div>
                <div class="span4">
                    <?php global $timer_start; ?>
                    <p class="muted pull-right">
                        Generated in {{ round((microtime(1) - $timer_start), 4) }} sec.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{ Basset::show('main.js') }}
@section('js')
@show
@if (Config::get('analytics.google'))
    @include('partials.analytics')
@endif
{{ Basset::show('extra.js') }}
