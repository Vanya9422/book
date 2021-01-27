module.exports = {
	parserOptions: {
		parser: 'babel-eslint',
	},
	
	extends: [
		'plugin:vue/recommended',
		'standard',
	],
	
	plugins: ['vue'],
	
	rules: {
		'indent': ['error', 'tab'],
		'no-tabs': 0,
		'array-bracket-spacing': ['error', 'never'],
		'semi': ['error', 'always'],
		'no-trailing-spaces': 'off',
		'import/first': 'off',
		'no-undef': 'off',
		'prefer-const': 'off',
		'quotes': ['error', 'single', { allowTemplateLiterals: true }],
		'quote-props': ['error', 'consistent'],
		'no-extra-semi': ['error'],
		'object-curly-spacing': ['error', 'always'],
		
		'comma-dangle': [
			'error',
			'always-multiline',
			{ functions: 'never' },
		],
		
		'space-before-function-paren': [
			'error',
			{ anonymous: 'always', named: 'never', asyncArrow: 'always' },
		],
		
		'vue/html-indent': [
			'error',
			'tab',
			{ attribute: 1, baseIndent: 1, closeBracket: 0, alignAttributesVertically: false, ignores: [] },
		],
		
		'vue/script-indent': [
			'error',
			'tab',
			{ baseIndent: 1, switchCase: 1 },
		],
		
		'vue/max-attributes-per-line': 'off',
		'vue/html-quotes': ['error', 'double'],
		
		'vue/singleline-html-element-content-newline': [
			'error',
			{ ignoreWhenNoAttributes: false },
		],
		
		'vue/multiline-html-element-content-newline': ['error'],
		'vue/order-in-components': ['error'],
		'vue/require-default-prop': ['error'],
		
		'vue/html-closing-bracket-newline': [
			'error',
			{ singleline: 'never', multiline: 'never' },
		],
		
		'vue/array-bracket-spacing': ['error', 'never'],
		'vue/this-in-template': ['error'],
		'vue/object-curly-spacing': ['error', 'always'],
		'vue/attributes-order': ['error'],
		
		'vue/html-self-closing': [
			'error',
			{
				'html': {
					'void': 'never',
					'normal': 'never',
					'component': 'always',
				},
				
				'svg': 'never',
				'math': 'never',
			},
		],
	},
	
	overrides: [
		{
			files: ['*.vue'],
			
			rules: {
				'indent': 'off',
			},
		},
	],
};
