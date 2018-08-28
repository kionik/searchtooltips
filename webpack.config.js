const webpack = require('webpack');
const path = require('path');
const appconfig = require('./appconfig');
module.exports = {
    context: path.join(__dirname, appconfig.templateDirectoryPath + '/src'),
    entry: './app.js',
    output: {
        filename: "bundle.js",
        path: path.join(__dirname, appconfig.templateDirectoryPath + '/dist')
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        }
    },
    devtool: "eval",
};