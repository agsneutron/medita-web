const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/admin/app.js', 'public/js/admin').vue()
    .js('resources/js/admin/auth/app.js', 'public/js/admin/auth').vue()
    .sass('resources/sass/admin/index.scss', 'public/css/admin')
    .sass('resources/sass/admin/login.scss', 'public/css/admin');
