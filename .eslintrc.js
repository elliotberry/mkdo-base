module.exports = {
	env: {
		browser: true,
		es6: true,
	},
	extends: ['wordpress', 'prettier'],
	parserOptions: {
		ecmaVersion: 2018,
		sourceType: 'module',
	},
	rules: {
		indent: ['error', 'tab'],
		quotes: ['error', 'single'],
	},
};
