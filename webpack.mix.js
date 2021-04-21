const mix = require('laravel-mix');

var path = require('path')
var webpack = require('webpack')
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

mix

    //admin
    .js('resources/assets/js/admin/vendor.js', 'public/js/admin')
    .js('resources/assets/js/admin/app.js', 'public/js/admin').vue()


    .sass('resources/assets/sass/admin/login.scss', 'public/css/admin')
    .sass('resources/assets/sass/admin/vendor.scss', 'public/css/admin')
    .sass('resources/assets/sass/admin/app.scss', 'public/css/admin')

    .js('resources/assets/js/client/vendor.js', 'public/js/client')
    .js('resources/assets/js/client/app.js', 'public/js/client')

    .sass('resources/assets/sass/client/vendor.scss', 'public/css/client')
    .sass('resources/assets/sass/client/app.scss', 'public/css/client')


    .sourceMaps();