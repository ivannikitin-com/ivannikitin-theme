const path = require('path');

module.exports = {
  entry: './assets/app/js/index.js',
  output: {
    path: path.resolve(__dirname, './assets'),
    filename: './public/js/script.min.js',
    publicPath: 'assets/'
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        // exclude: /node_modules/
      }
    ]
  }
}