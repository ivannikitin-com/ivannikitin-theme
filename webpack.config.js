const path = require('path'),
      autoprefixer = require('autoprefixer'),
      MiniCssExtractPlugin = require('mini-css-extract-plugin'),
      UglifyJSPlugin = require('uglifyjs-webpack-plugin'),
      OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin'),
      BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  context: __dirname,
  entry: {
    frontend: ['babel-polyfill', './assets/app/js/index.js'],
    customizer: './assets/app/js/customizer.js'
  },
  output: {
    path: path.resolve(__dirname, 'assets/public/js'),
    filename: '[name]-bundle.js'
  },
  mode: 'development',
  devtool: 'source-map',
  module: {
    rules: [
      {
        enforce: 'pre',
        exclude: /node_modules/,
        test: /\.js$/,
        loader: 'eslint-loader'
      },
      {
        test: /\.js?$/,
        loader: 'babel-loader'
      },
      {
        test: /\.s?css$/,
        use: [
          MiniCssExtractPlugin.loader, 
          {
            loader: "css-loader", 
            options: {
              sourceMap: true
            }
          },
          {
            loader: 'postcss-loader', // Run post css actions
            options: {
              plugins: [
                autoprefixer({
                  grid: "autoplace",
                  browsers:['> 1%', 'last 2 versions']
                })
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
      },
      {
        test: /\.(jpe?g|png|gif)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: '../images/'
            }
          },
          'img-loader'
        ]
      },
      {
        test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
        use: [{
            loader: 'file-loader',
            options: {
                name: '[name].[ext]',
                outputPath: '../fonts/'
            }
        }]
      },
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({ filename: '../css/style.css' }),
    new BrowserSyncPlugin({
      files: '**/*.php',
      injectCss: true,
      proxy: 'http://ivannikitin.local'
    })
  ],
  optimization: {
    minimizer: [
      new UglifyJSPlugin(), 
      new OptimizeCssAssetsPlugin()
    ]
  }
}
