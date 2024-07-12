const path = require('path');

const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const JS_DIR = path.resolve(__dirname, 'js');
const IMG_DIR = path.resolve(__dirname, 'img');
const BUID_DIR = path.reslove(__dirname, 'build');

const entry = {
    main: JS_DIR + '/phoenix.js',

};
const output = {
    path: BUID_DIR,
    filename: 'js/[name].js',
};

const rules = [
    {
        test: /\.js$/,
        include: [JS_DIR],
        exclude: /node_modules/,
        use: 'babel-loader'
    },
    {
        test: /\.scss$/,
        exclude: /node_modules/,
        use: [MiniCssExtractPlugin.loader, 'css-loader']
    },
    {
        test: /\.(png|jpg|svg|gif|jpeg|webp|ico|)$/,
        use: [{
            loader: 'file-loader',
            options: {
                name: '[name].[ext]',
                publicPath: 'production' === process.env.NODE_ENV ? '../' : '../../',
            }
        }]
    },

];

const plugins = (argv) => [
    new CleanWebpackPlugin(
        {
            cleanStaleWebpackAssets: ('production' !== argv.mode),
        }
    ),
    new MiniCssExtractPlugin(
        {
            filename: 'css/[name].css',
        }
    ),
];

module.exports = (env, argv) => ({
    entry: entry,
    output: output,
    devtool: 'source-map',
    module: {
        rules: rules
    },
    plugins: plugins(argv),
    externals: {
        jquery: 'jQuery'
    }
})


