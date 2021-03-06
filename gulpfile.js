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
    mix.sass('app.scss');
    //mix.less('');

    mix.copy(
    	'./public/js/libs/semantic/dist/themes',
    	'./public/css/themes'
    );

    mix.styles([
    	'./public/js/libs/semantic/dist/semantic.min.css'
    ],
    'public/css/nestor.css');

 //    mix.scripts([
 //    	'./resources/assets/bower/jquery/dist/jquery.js',
 //    	'./resources/assets/bower/bootstrap-sass-official/assets/javascripts/bootstrap.min.js'
	// ],
	// 'public/js/nestor.js');
});
