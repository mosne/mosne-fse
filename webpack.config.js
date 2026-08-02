const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );

/**
 * CSS-only entries: import the SCSS from a thin JS file so @wordpress/scripts
 * emits `{stylesheet}-{entry}.css` (e.g. style-index.css), matching create-block.
 */
module.exports = {
	...defaultConfig,
	entry: {
		index: path.resolve( process.cwd(), 'src/index.js' ),
		scripts: path.resolve( process.cwd(), 'src/scripts.js' ),
		'blocks/selected-works/index': path.resolve(
			process.cwd(),
			'blocks/selected-works/index.js'
		),
		'blocks/selected-works/view': path.resolve(
			process.cwd(),
			'blocks/selected-works/view.js'
		),
		'blocks/custom-gallery/index': path.resolve(
			process.cwd(),
			'blocks/custom-gallery/index.js'
		),
		'blocks/custom-gallery/view': path.resolve(
			process.cwd(),
			'blocks/custom-gallery/view.js'
		),
		'blocks/circle/index': path.resolve(
			process.cwd(),
			'blocks/circle/index.js'
		),
		'blocks/archive-works/index': path.resolve(
			process.cwd(),
			'blocks/archive-works/index.js'
		),
		'blocks/copyright/index': path.resolve(
			process.cwd(),
			'blocks/copyright/index.js'
		),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve( process.cwd(), 'dist' ),
	},
	plugins: defaultConfig.plugins.filter(
		( plugin ) => plugin.constructor.name !== 'RtlCssPlugin'
	),
};
