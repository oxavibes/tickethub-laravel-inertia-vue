import { computed } from 'vue';

/**
 * Create a set of computed properties for checking roles and permissions.
 * @param {Object} options - Options for configuring the roles and permissions.
 * @param {string[]} options.roles - An array of role names.
 * @param {string[]} options.permissions - An array of permission names.
 * @returns {Object} An object containing computed properties for checking roles and permissions.
 */
export default ({ roles = [], permissions = [] }) => {
	/**
	 * Check if the provided role is present in the roles array.
	 * @function
	 * @param {string} role - The role to check.
	 * @returns {boolean} True if the role is present, false otherwise.
	 */
	const hasRole = computed(() => (role) => roles.includes(role));

	/**
	 * Check if the provided permission is present in the permissions array.
	 * @function
	 * @param {string} permission - The permission to check.
	 * @returns {boolean} True if the permission is present, false otherwise.
	 */
	const hasPermission = computed(() => (permission) => permissions.includes(permission));

	return {
		hasRole,
		hasPermission,
	};
};
