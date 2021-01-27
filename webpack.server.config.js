const merge = require('webpack-merge');
const nodeExternals = require('webpack-node-externals');
const VueSSRServerPlugin = require('vue-server-renderer/server-plugin');
const baseConfig = require('./webpack.base.config.js');
const path = require('path');
const isProduction = process.env.NODE_ENV === 'production';
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = merge(baseConfig, {
	entry: './resources/js/entry-server.js',
	target: 'node',
	devtool: 'source-map',
	
	output: {
		path: path.resolve('./public/'),
		libraryTarget: 'commonjs2',
	},
	
	externals: nodeExternals({
		whitelist: /\.(css|scss|sass)$/,
	}),
	
	plugins: [
		new VueSSRServerPlugin(),
	].concat(isProduction ? [
		// new MiniCssExtractPlugin(),
	]: []),
 
	module: {
		rules: [
			{
				test: /\.(css|scss|sass)$/,
				
				use: [
					// isProduction ? MiniCssExtractPlugin.loader : 'vue-style-loader',
					{
						loader: 'css-loader',
					},
					'sass-loader',
				],
			},
		],
	},
});
