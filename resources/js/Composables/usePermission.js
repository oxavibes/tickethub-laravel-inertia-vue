import { computed } from 'vue';

export default ({ roles = [], permissions = [] }) => {
	const hasRole = computed(() => (role) => roles.includes(role))
	const hasPermission = computed(() => (permission) => permissions.includes(permission))

	return {
		hasRole,
		hasPermission,
	}
}
