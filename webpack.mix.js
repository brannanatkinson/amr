const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.scripts(['semantic/dist/semantic.js','resources/assets/js/app.js'], 'public/js/all.js');
   //.sass('resources/assets/sass/app.scss', 'public/css');

mix.copy('semantic/dist/semantic.css', 'public/css/semantic.css');
//mix.copy('semantic/dist/semantic.js', 'public/js/semantic.js')
