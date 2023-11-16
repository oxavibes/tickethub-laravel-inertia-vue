import forms from '@tailwindcss/forms';
import flowbite from 'flowbite/plugin';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/js/**/*.vue',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		'./node_modules/flowbite/**/*.js',
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ['Figtree', ...defaultTheme.fontFamily.sans],
			},
		},
	},

	plugins: [forms, flowbite()],
};
