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

    mix.sass('app.scss');

    mix.styles([
    	'root.css',
        'app.css'
    ],null,'public/css')

    mix.scripts([

    	'/vendor/jquery.min.js',
    	'/vendor/bootstrap.min.js',
    	'/vendor/plugins.js'

    ],null,'public/js')

});
