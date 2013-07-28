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
                    <p class="muted pull-right">Generated in {{ round((microtime(1) - $timer_start), 4) }} sec.</p>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>

<script src="{{ asset('js/restfulizer.js') }}"></script>
<script src="{{ asset('js/hotkeys.js') }}"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-lightbox/0.6.1/bootstrap-lightbox.min.js"></script>
<script src="{{ asset('js/select.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/1.5/bootstrap-switch.min.js"></script>
<script src="{{ asset('js/wysiwyg.js') }}"></script>

<script src="{{ asset('js/prettify.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
