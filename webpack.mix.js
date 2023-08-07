const mix = require('laravel-mix')

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
  .js('resources/js/app.js', 'public/js')
  .js('resources/js/fileUpload.js', 'public/js/fileUpload.js')
  .js('resources/js/jquery.js', 'public/js/jquery.js')
  .js('resources/js/menu.js', 'public/js/menu.js')
  //   .js('resources/js/createDare.js', 'public/js/createDare.js')
  //   .js('resources/js/createQuizze.js', 'public/js/createQuizze.js')
  //   .js('resources/js/createChoice.js', 'public/js/createChoice.js')
  .sass('resources/sass/app.scss', 'public/css')
  .postCss('resources/css/app.css', 'public/css/custom.css', [
    require('tailwindcss'),
  ])
  .sourceMaps()

mix.copyDirectory('resources/images', 'public/images')
