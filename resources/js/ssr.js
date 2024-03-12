import '../css/app.css';

import { createSSRApp, h } from 'vue';
import { renderToString } from '@vue/server-renderer';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer((page) =>
	createInertiaApp({
		page,
		render: renderToString,
		title: (title) => `${title} - ${appName}`,
		resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
		setup({ App, props, plugin }) {
			return createSSRApp({ render: () => h(App, props) })
				.component('Link', Link)
				.component('Head', Head)
				.component('GuestLayout', GuestLayout)
				.component('AuthenticatedLayout', AuthenticatedLayout)
				.use(plugin)
				.use(ZiggyVue, {
					...page.props.ziggy,
					location: new URL(page.props.ziggy.location),
				});
		},
	}),
	process.env.VITE_INERTIA_SSR_PORT || 13714
);
