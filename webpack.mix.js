const mix = require('laravel-mix');
// require('laravel-mix-purgecss');
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

// mix.js('resources/js/app.js', 'public/js').sass('resources/sass/app.scss', 'public/css');
//js('resources/js/dinway.js', 'public/js').
mix
    .js('resources/js/dinway.js', 'public/js')
    .sass('resources/sass/dinway.sass', 'public/css')
    .sass('resources/sass/dinway/independents/faq.sass', 'public/css')
    .sass('resources/sass/dinway/independents/suggestions.scss', 'public/css')
    .sass('resources/sass/dinway/independents/blog.sass', 'public/css')
    .sass('resources/sass/dinway/independents/materials.sass', 'public/css')
    .js('resources/js/dinway/faq.js', 'public/js')
    .js('resources/js/dinway/blog.js', 'public/js');
