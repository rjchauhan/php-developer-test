var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .styles([
            'vendor/sweetalert/sweetalert.css',
            'app.css'
        ])

        .scripts([
            'vendor/vue/vue.js',
            'vendor/vue/vue-resource.js',
            'vendor/sweetalert/sweetalert.min.js',
            'app.js'
        ])

        .version([
            'public/css/all.css',
            'public/js/all.js'
        ]);
});
