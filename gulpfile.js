//disable gulp notifications to avoid issues with gulp-notify on Homestead VMs
process.env.DISABLE_NOTIFIER = true

var elixir = require('laravel-elixir');
//
stylesPath = 'public/assets/styles/';
scriptsPath = 'public/assets/scripts/';

elixir.config.css.outputFolder = stylesPath;
elixir.config.js.outputFolder = scriptsPath;
//disable source maps
elixir.config.sourcemaps = false;
/*
 * This is the Elixir gulpfile. It is used by Bootstrap CMS for asset management.
 */
elixir(function (mix) {
    //Bootstrap themes
    mix.copy('resources/assets/css/bootstrap.*.min.css', stylesPath);
    mix.styles(['bootstrap.min.css'], stylesPath + 'bootstrap.default.min.css');
    mix.styles(['bootstrap.min.css', 'bootstrap-theme.min.css'], stylesPath + 'bootstrap.legacy.min.css');

    //BoostrapCMS styles (custom style sheets used site-wide may be added to the array below).
    mix.styles(['cms-main.css'], stylesPath + 'cms-main.css');

    //BootstrapCMS scripts
    mix.scripts(['cms-timeago.js', 'cms-restfulizer.js', 'cms-carousel.js', 'cms-alerts.js'], scriptsPath + 'cms-main.js');
    mix.scripts(['cms-picker.js'], scriptsPath + 'cms-picker.js');
    mix.scripts(['cms-comment-core.js', 'cms-comment-edit.js', 'cms-comment-delete.js', 'cms-comment-create.js', 'cms-comment-fetch.js', 'cms-comment-main.js'], scriptsPath + 'cms-comment.js');

    //maximebf/DebugBar assets
    mix.copy('vendor/maximebf/debugbar/src/DebugBar/Resources/vendor/highlightjs/styles/github.css', stylesPath + 'debugbar.css')
    mix.copy('vendor/maximebf/debugbar/src/DebugBar/Resources/vendor/highlightjs/highlight.pack.js', scriptsPath + 'debugbar.js')
});
