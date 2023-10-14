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

 mix.disableNotifications()
 .browserSync({
            // fixes pagination urls otherwise they get re-written to use the service `container_name`...
            host: 'localhost',
            // service container_name...
            proxy: 'dev_web_fruit_supplier', 
            // matches the port number exposed earlier...
            port: 3000, 
            open: false,
 });
