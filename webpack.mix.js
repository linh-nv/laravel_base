const config = require('./webpack.config');
const mix = require('laravel-mix');

function resolve(dir) {
    return path.join(
        __dirname,
        '/resources/js',
        dir
    );
}

Mix.listen('configReady', webpackConfig => {
    // Add "svg" to image loader test
    const imageLoaderConfig = webpackConfig.module.rules.find(
        rule =>
            String(rule.test) ===
            String(/(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/)
    );
    imageLoaderConfig.exclude = resolve('icons');
});

mix.webpackConfig(config);

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
/*mix.copyDirectory('node_modules/bootstrap/scss', 'public/libs/bootstrap');
mix.copyDirectory('node_modules/slick-carousel/slick', 'public/libs/slick-carousel');
mix.copyDirectory('node_modules/owl.carousel/src', 'public/libs/owl-carousel');
mix.copyDirectory('node_modules/font-awesome', 'public/libs/font-awesome');*/
mix.copyDirectory('node_modules/alertifyjs/build/css', 'public/libs/alertifyjs/css');
mix.copyDirectory('node_modules/bootstrap/scss', 'public/libs/bootstrap');
mix.copyDirectory('node_modules/select2/dist/css/select2.min.css', 'public/libs/select2/select2.min.css');
mix.copyDirectory('node_modules/jquery-autocomplete/jquery.autocomplete.css', 'public/libs/jquery-autocomplete/jquery.autocomplete.css');
mix.sass('public/libs/bootstrap/bootstrap.scss', 'public/libs/bootstrap/bootstrap.css');
mix.styles([
    'public/libs/bootstrap/bootstrap.css',
    'public/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css',
    'public/libs/alertifyjs/css/alertify.min.css',
    'public/libs/alertifyjs/css/themes/default.min.css',
    'public/client/assets/css/icons.css',
    'public/client/assets/css/metismenu.min.css',
    'public/client/assets/css/typicons.css',
    'public/libs/select2/select2.min.css',
    'public/libs/jquery-autocomplete/jquery.autocomplete.css',
], 'public/css/libs.css')
    .styles([
        'public/client/assets/css/style.css',
        'public/client/page/css/style.css',
    ], 'public/css/home.css')
    .extract([
        'jquery',
        'select2',
        'tether',
        'bootstrap',
        'jquery-slimscroll',
        'jquery-scrollTo',
    ]).js([
    'public/client/assets/js/waves.js',
    'public/client/assets/js/jquery.core.js',
    'public/client/assets/js/jquery.app.js',
    'public/libs/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
    'public/libs/bootstrap-inputmask/bootstrap-inputmask.min.js',
    'public/client/page/js/script.js'
], 'public/js/home.js');


if (mix.inProduction()) {
    mix.version();
} else {
    // Development settings
    mix.version();
    // .sourceMaps()
    // .webpackConfig({
    //   devtool: 'cheap-eval-source-map', // Fastest for development
    // });
}

