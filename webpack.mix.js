const mix = require('laravel-mix');
const MinifyHtmlWebpackPlugin = require('minify-html-webpack-plugin');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .extract(['jquery', 'bootstrap', 'popper.js'])
    .sourceMaps()
    .version();

if (! mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'source-map'
    })
}

// // fix css files 404 issue
mix.webpackConfig({
    // add any webpack dev server config here
    devServer: {
        proxy: {
            host: '0.0.0.0',  // host machine ip
            port: 8080,
        },
        watchOptions:{
            aggregateTimeout:200,
            poll:5000
        },

    },
    plugins: [
        new MinifyHtmlWebpackPlugin({
            src: './storage/framework/views',
            ignoreFileNameRegex: /\.(gitignore)$/,
            rules: {
                collapseWhitespace: true,
                removeAttributeQuotes: true,
                removeComments: true,
                minifyJS: true,
            }
        })
    ]
});
