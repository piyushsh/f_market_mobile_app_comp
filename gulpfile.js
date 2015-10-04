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
    //mix.sass('app.scss');
    mix.sass('app-style.scss','public/css/app-style.css');
});

elixir(function(mix){
    //Coping all the script files to Public folder
    mix.copy('resources/assets/js','public/js');

    //Setting up bootstrap in public folder
    mix.copy('vendor/twbs/bootstrap/dist/css','public/css');
    mix.copy('vendor/twbs/bootstrap/dist/js','public/js');
    mix.copy('vendor/twbs/bootstrap/dist/fonts','public/fonts');

});

//Setting Up Angular scripts
elixir(function(mix){
    mix.scripts(['app/app.js'],'public/js/app/app.js');
});
