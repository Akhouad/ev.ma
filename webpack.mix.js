let mix = require('laravel-mix');

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

mix.js('resources/assets/js/manager/app.js', 'public/js/manager')
    .js('resources/assets/js/manager/intervenants.js', 'public/js/manager')
    .js('resources/assets/js/manager/schedule.js', 'public/js/manager')
    .js('resources/assets/js/manager/images.js', 'public/js/manager')
   .sass('resources/assets/sass/manager/app.scss', 'public/css/manager');
