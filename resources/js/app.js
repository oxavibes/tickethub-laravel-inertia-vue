import './bootstrap';
import '../css/app.css';

import { createSSRApp, h } from 'vue';
import { createPinia } from 'pinia'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
	setup({ el, App, props, plugin }) {
		return createSSRApp({ render: () => h(App, props) })
			.component('Link', Link)
			.component('Head', Head)
			.component('GuestLayout', GuestLayout)
			.component('AuthenticatedLayout', AuthenticatedLayout)
			.use(plugin)
			.use(createPinia())
			.use(ZiggyVue)
			.mount(el);
	},
	progress: {
		color: '#4B5563',
	},
});
