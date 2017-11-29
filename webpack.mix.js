let mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.sass('resources/assets/sass/app.scss', 'public/css').options({
    processCssUrls: false,
    postCss: [tailwindcss('tailwind.js')]
});

mix.copyDirectory('resources/assets/img', 'public/img');
mix.copyDirectory('resources/assets/fonts', 'public/fonts');

if (mix.inProduction()) {
    mix.browserSync({
        proxy: '127.0.0.1:8000'
    });
}
