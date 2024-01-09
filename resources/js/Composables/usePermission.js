import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

export default () => {
	const hasRole = computed(() => (role) => usePage().props.auth.roles.includes(role))
	const hasPermission = computed(() => (permission) => usePage().props.auth.permissions.includes(permission))

	return {
		hasRole,
		hasPermission,
	}
}
