const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/firebase.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.jsx', '.mjs', '.json', '.cjs']
    }
});
