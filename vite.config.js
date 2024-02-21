import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

const vitestConfig = {
	test: {
		globals: true,
		environment: 'happy-dom',
	},
}

export default defineConfig({
	test: vitestConfig.test,
	build: {
		chunkSizeWarningLimit: 1500,
	},
	plugins: [
		laravel({
			input: 'resources/js/app.js',
			ssr: 'resources/js/ssr.js',
			refresh: true,
		}),
		vue({
			template: {
				transformAssetUrls: {
					base: null,
					includeAbsolute: false,
				},
			},
		}),
	],
	ssr: {
		noExternal: ['@inertiajs/server'],
	},
});
