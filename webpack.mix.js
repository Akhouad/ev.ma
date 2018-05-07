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
    .js('resources/assets/js/manager/comments.js', 'public/js/manager')
    .js('resources/assets/js/manager/email.js', 'public/js/manager')
    .js('resources/assets/js/manager/common.js', 'public/js/manager')
    .sass('resources/assets/sass/manager/app.scss', 'public/css/manager')

    .js('resources/assets/js/site/common.js', 'public/js/site')
    .js('resources/assets/js/site/home.js', 'public/js/site')
    .js('resources/assets/js/site/event.js', 'public/js/site')
   .sass('resources/assets/sass/site/app.scss', 'public/css/site');
