const path = require('path');
const webpack = require('webpack');

function resolve(dir) {
    return path.join(
        __dirname,
        '/resources/js',
        dir
    );
}

module.exports = {
    plugins: [
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            "window.jQuery": "jquery",
            "window.Tether": 'tether',
            Tether: 'tether'
        })],
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '@': path.join(__dirname, '/resources/js'),
        },
    },
    module: {
        rules: [
            {
                test: /\.svg$/,
                loader: 'svg-sprite-loader',
                include: [resolve('icons')],
                options: {
                    symbolId: 'icon-[name]',
                },
            },
            {
                test: /[\\\/]node_modules[\\\/]bootstrap[\\\/]dist[\\\/]js[\\\/]bootstrap\.min\.js$/,
                loader: 'tether',
            },
            {
                test: /[\\\/]public[\\\/]client[\\\/]assets[\\\/]js[\\\/]bootstrap\.min\.js$/,
                loader: [
                    'imports?this=>window!exports?window.Tether',
                ],
            },
        ],
    },
    node: {
        fs: 'empty',
        child_process: 'empty',
    },
};
