var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('material.less');

    mix.sass('app.scss');

    mix.styles([
        // 'vendor/bootstrap-paper.min.css',
    	'vendor/bootstrap.min.css',
    	'vendor/font-awesome.min.css',
        "vendor/sweet-alert.css",
        "vendor/video-js-resolutions.css",
        "vendor/select2.css",
        'css/app.css',
        'css/material.css'
    ], 'public/output/final.css', 'public');


    mix.scriptsIn('resources/assets/js', 'public/js/app.js');

    mix.scripts([
		"js/app.js",
		"vendor/video.dev.js",
        "vendor/video-js-resolutions.js",
        "vendor/trunc8.js",
        "vendor/sweet-alert.js",
        "vendor/sortable.js",
        "vendor/select2.js"
	], "public/output/final.js", 'public');

});
