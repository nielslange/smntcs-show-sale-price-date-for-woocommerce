module.exports = {
	...require( '@wordpress/prettier-config' ),
	overrides: [
		{
			files: '*.yml',
			options: {
				tabWidth: 2,
			},
		},
	],
	editorconfig: true,
};
