const webpack = require('webpack');
const merge = require('webpack-merge');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const path = require('path');
const isProduction = process.env.NODE_ENV === 'production';

let config = {
	mode: isProduction ? 'production' : 'development',
	
	module: {
		rules: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
			},
			{
				test: /\.js$/,
				use: ['babel-loader'],
				exclude: file => /node_modules/.test(file) && !/\.vue\.js/.test(file),
			},
			{
				test: /\.(js|vue)$/,
				exclude: /node_modules/,
				loader: 'eslint-loader',
				enforce: 'pre',
			},
			{
				test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
				
				use: {
					loader: 'url-loader',
					
					options: {
						limit: 10000,
						name: 'images/[name].[ext]?[hash:8]',
					},
				},
			},
		],
	},
	
	resolve: {
		extensions: ['*', '.js', '.vue', '.json'],
		
		alias: {
			'vue$': 'vue/dist/vue.runtime.js',
			'jquery': 'jquery/dist/jquery.slim',
			'@': path.resolve('resources'),
		},
	},
	
	plugins: [
		new VueLoaderPlugin(),
		
		new webpack.DefinePlugin({
			'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV),
		}),
	],
};

if (isProduction) {
	config = merge(config, {
		optimization: {
			minimize: false,
			// minimizer: [new OptimizeCSSAssetsPlugin(), new UglifyJsPlugin()],
		},
	});
}

module.exports = config;
