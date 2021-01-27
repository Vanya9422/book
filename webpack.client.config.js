const webpack = require('webpack');
const merge = require('webpack-merge');
const VueSSRClientPlugin = require('vue-server-renderer/client-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const path = require('path');

const baseConfig = require('./webpack.base.config.js');

const isProduction = process.env.NODE_ENV === 'production';

let config = merge(baseConfig, {
	entry: ['./resources/js/entry-client.js'],
	plugins: [new VueSSRClientPlugin()],
	
	output: {
		path: path.resolve('./public/'),
		filename: 'js/[name].js?[hash:8]',
		publicPath: '/',
	},
	
	module: {
		rules: [
			{
				test: /\.(css|scss|sass)$/,
				
				use: [
					isProduction ? MiniCssExtractPlugin.loader : 'vue-style-loader',
					{
						loader: 'css-loader',
					},
					'sass-loader',
				],
			},
		],
	},
	
	resolve: {
		alias: {
			'vue$': 'vue/dist/vue.esm.js',
		},
	},
});

if (isProduction) {
	config = merge(config, {
		plugins: [
			new MiniCssExtractPlugin({
				filename: 'css/[name].css?[hash:8]',
			}),
		],
	});
} else {
	config = merge(config, {
		output: {
			hotUpdateMainFilename: 'hot/hot-update.json?[hash]',
			hotUpdateChunkFilename: 'hot/[id].hot-update.js?[hash]',
		},
		
		devServer: {
			writeToDisk: true,
			contentBase: path.resolve(__dirname, './public/'),
			publicPath: '/',
			hot: true,
			hotOnly: true,
			inline: true,
			historyApiFallback: true,
			disableHostCheck: true,
			port: 9999,
		},
		
		plugins: [new webpack.HotModuleReplacementPlugin()],
		devtool: 'eval',
	});
}

module.exports = config;