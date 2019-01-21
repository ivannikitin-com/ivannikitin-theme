const path = require('path');
const webpack = require('webpack');
const autoprefixer = require('autoprefixer');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");


const DEV = process.env.NODE_ENV === 'development';

module.exports = {
  entry: './assets/app/js/index.js',
  output: {
    path: path.resolve(__dirname, './assets'),
    filename: './public/js/script.min.js',
    publicPath: 'assets/'
  },
  devtool: DEV ? 'cheap-eval-source-map' : 'source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        // exclude: /node_modules/
      },
      {
        test: /\.(scss)$/,
        use: ExtractTextPlugin.extract({
          fallback: 'style-loader',
          use: [
            {
              loader: 'css-loader',
              options: {
                importLoaders: 1
              },
            },
            {
              loader: 'postcss-loader',
              options: {
                plugins: () => [
                  autoprefixer({
                    grid: "autoplace",
                    browsers: [
                      '>1%',
                      'last 4 versions',
                      'Firefox ESR',
                      'not ie < 9', // React doesn't support IE8 anyway
                    ],
                  }),
                ],
              }
            },
            {
              loader: 'sass-loader',
              options: {
                sourceMap: true
              }
            }
          ]
        })
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin('public/css/style.min.css'),
  ],
  optimization: {
    minimizer: [
      !DEV &&
      new UglifyJsPlugin({
        sourceMap: true,
      }),
      !DEV &&
      new OptimizeCSSAssetsPlugin()
    ]
  }
}