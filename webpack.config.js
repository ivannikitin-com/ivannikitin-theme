const path = require('path'),
  webpack = require('webpack'),
  UglifyJSPlugin = require('uglifyjs-webpack-plugin'),
  MiniCssExtractPlugin = require('mini-css-extract-plugin'),
  OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin'),
  CleanWebpackPlugin = require('clean-webpack-plugin'),
  BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: {
    app: './src/index.js',
    style: './src/sass/style.scss',
    woocommerce: './src/sass/woocommerce.scss'
  },
  output: {
    filename: './build/[name].min.js',
    path: path.resolve(__dirname)
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        loader: 'babel-loader',
        exclude: /node_modules/
      },
      {
        test: /\.(scss|css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: {} },
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [
                require('autoprefixer')({
                  browsers: ['> 1%', 'last 2 versions']
                })
              ]
            }
          },
          { loader: 'sass-loader', options: {} }
        ]
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              publicPath: 'build/images',
              outputPath: 'build/images/',
              name: '[name].[ext]'
            }
          }
        ]
      },
      {
        test: /\.(eot|woff|woff2|ttf)([\?]?.*)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              publicPath: 'build/fonts',
              outputPath: 'build/fonts',
              name: '[name].[ext]'
            }
          }
        ]
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: './[name].css'
    }),
    new CleanWebpackPlugin(['./build/*']),
    new BrowserSyncPlugin({
      proxy: 'https://ivannikitin.local/',
      files: ['**/*.php'],
      reloadDelay: 0
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery'
    })
  ],
  optimization: {
    minimizer: [
      new UglifyJSPlugin({
        cache: true,
        parallel: true
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  }
};
