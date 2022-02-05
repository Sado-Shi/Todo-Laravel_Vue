const path = require('path');

module.exports = {
  resolve: {
    alias: {
      '@': path.resolve('resources/js'),
    },
  }
  // module: {
  //   rules: [{
  //     test: /\.svg$/,
  //     use: [
  //       'babel-loader',
  //       'vue-svg-loader',
  //     ],
  //   }, ],
  // },
};
