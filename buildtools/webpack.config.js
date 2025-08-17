const path = require('path');

module.exports = {
  entry: '../app/src/app.js',
  output: {
    path: path.resolve(__dirname, '../public/static/app'),
    filename: 'app.js',
    chunkFilename: (pathData) => {
      // Convert chunk names to lowercase
      const name = pathData.chunk.name || pathData.chunk.id;
      const lowerName = name.toString().toLowerCase();
      return `${lowerName}.[contenthash].js`;
    },
    publicPath: '/static/app/',
    clean: true // Clean the output directory before emit
  },
  resolve: {
    extensions: ['.js', '.jsx'],
    alias: {
      '@': path.resolve(__dirname, '../app/src'),
    }
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-react']
          }
        }
      },
    ]
  },
  devServer: {
    static: {
      directory: path.join(__dirname, '../public'),
    },
    proxy: {
      '/': {
        target: 'http://localhost:8000',
        bypass: function(req) {
          if (req.url.startsWith('/static/')) {
            return req.url;
          }
        }
      }
    },
    port: 3000,
    open: true,
    hot: true
  }
};
