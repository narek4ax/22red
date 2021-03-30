/*!
 * --------------------------------------------------------------
 * Configuration:  Denis Kabistan
 * denis@dirango.com
 * -------------------------------------------------------------- 
*/
const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
  watch: true,
  performance: {
    hints: false
  },
  mode: 'production',
  entry: {
    core: ['./src/es6/core.js', './src/scss/style.scss']
  },
  output: {
    path: __dirname + '/',
    filename: 'js/[name].min.js'
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          chunks: 'all'
        }
      }
    }
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        query: {
          presets: ['env'],
          cacheDirectory: true,
        }
      },
      {
        test: /\.(css|sass|scss)$/,
        loader: ExtractTextPlugin.extract({
          use: [
            {
              loader: 'css-loader',
              options: {
                minimize: true
              }
            },
            {
              loader: 'sass-loader',
              options: {
                includePaths: [
                  __dirname + '/node_modules',
                  __dirname + '/src/scss',
                  __dirname + '/node_modules/bootstrap'
                ]
              }
            }
          ],
            fallback: 'style-loader'
        })
      },
      {
        test: /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        loader: 'url-loader?limit=10000',
        options: {
          name: '/fonts/[name].[ext]'
        }
      },
      {
        test: /\.(ttf|eot|svg)(\?[\s\S]+)?$/,
        loader: 'file-loader'
      }
    ]
  },
  plugins: [
    new ExtractTextPlugin({
      filename: 'style.css',
      allChunks: true
    }),
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': '"production"'
    }),
    new webpack.ProvidePlugin({
      $: 'jquery',  
      jQuery: 'jquery',
      jquery: 'jquery',
      'window.jquery': 'jquery',
      'window.jQuery': 'jquery',
    })
  ]
}
