import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/js/**/*.vue',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ['Figtree', ...defaultTheme.fontFamily.sans],
			},
			colors: {
				black: '#000000',
				nickel: '#939393',
				persian: '#f9f9f9',
				yellow: '#F4BC2C',
			},
		},
	},

	plugins: [forms],
};
