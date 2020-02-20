const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js').extract([
    'jquery'
]).autoload({
    jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
}).sass('resources/sass/app.scss', 'public/css');

mix.copy('node_modules/tinymce', 'public/vendor/tinymce');
// mix.copy('node_modules/bxslider/dist/jquery.bxslider.min.js', 'public/js/jquery.bxslider.min.js');

//mix.copyDirectory('resources/img', 'public/img');