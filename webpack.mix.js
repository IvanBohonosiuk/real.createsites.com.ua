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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
    // .copy('node_modules/mdi/fonts', 'public/fonts')
    // .copy('node_modules/materialize-css/fonts', 'public/fonts');



// mix
//     .js('resources/assets/js/app.js', 'public/js')
//     .sass('resources/assets/sass/app.scss', 'public/css')

    // .copy('node_modules/materialize-css/fonts', 'public/build/fonts')


if (mix.config.inProduction) {
    mix
        .version()
        .sourceMaps();
}