const path = require("path")
const MiniCssExtractPlugin = require("mini-css-extract-plugin")
const IgnoreEmitPlugin = require("ignore-emit-webpack-plugin")
const BrowserSyncPlugin = require("browser-sync-webpack-plugin")

module.exports = {
	entry: {
		index: path.resolve(process.cwd(), "src", "index.js"),
		style: path.resolve(process.cwd(), "src", "sass", "style.scss"),
		gutenberg: path.resolve(process.cwd(), "gutenberg", "index.js"),
		"editor-style": path.resolve(process.cwd(), "src", "sass", "editor-style.scss"),
	},
	externals: {
		react: "React",
		"react-dom": "ReactDOM",
	},
	module: {
		rules: [
			{
				test: /\.m?js$/,
				exclude: /(node_modules|bower_components)/,
				use: {
					loader: "babel-loader",
					options: {
						presets: ["@babel/preset-react", "@babel/preset-env"],
						plugins: ["lodash", "@babel/plugin-proposal-class-properties"],
					},
				},
			},
			{
				test: /\.scss$/,
				use: [
					MiniCssExtractPlugin.loader, // creates style nodes from JS strings
					"css-loader", // translates CSS into CommonJS
					"postcss-loader",
					"sass-loader", // compiles Sass to CSS, using Node Sass by default,
					{
						loader: "sass-resources-loader",
						options: {
							resources: ["./src/sass/variables.scss", "./src/sass/mixins/**/*.scss"],
						},
					},
					"import-glob-loader",
				],
			},
			{
				test: /\.(png|jpg|gif|woff|woff2|svg)$/,
				use: [
					{
						loader: "file-loader",
						options: {
							name: "[name].[ext]",
						},
					},
				],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name].css",
			chunkFilename: "[id].css",
			ignoreOrder: false,
		}),
		new IgnoreEmitPlugin(["style.js", "editor-style.js", "woocommerce.js"]),
		new BrowserSyncPlugin({
			host: "localhost",
			port: 3000,
			proxy: "http://ivannikitin.local",
			files: [
				{
					match: ["**/*.php"],
				},
			],
		}),
	],
}
