process.env.NODE_ENV = process.env.NODE_ENV || 'production';
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   // .sass('resources/sass/app.scss', 'public/css')
   .version();
