const path = require("path")

module.exports = {
	entry: "./src/index.js",
	output: {
		path: path.resolve(__dirname, "dist"),
		filename: "bundle.js"
	},
	module: {
		loaders: [
			{
				test: /\.js$/,
				loaders: "babel-loader",
				exclude: path.join(__dirname, "../", "/node_modules/")
			},
			{
				test: /\.css$/,
				loaders: ["style-loader", "css-loader"] // ...with PostCSS
			}
		]
	},
	target: "web",
	watch: true
}
