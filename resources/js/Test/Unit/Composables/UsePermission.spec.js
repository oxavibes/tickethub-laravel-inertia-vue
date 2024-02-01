import useAuth from '@/Composables/usePermission';

describe('useAuth composable', () => {
	it('should return true if the user has the specified role', () => {
		const { hasRole } = useAuth({ roles: ['admin'], permissions: ['read'] });

		const result = hasRole.value('admin');

		expect(result).toBe(true);
	});

	it('should return false if the user does not have the specified role', () => {
		const { hasRole } = useAuth({ roles: ['admin'], permissions: ['read'] });

		const result = hasRole.value('editor');

		expect(result).toBe(false);
	});

	it('should return true if the user has the specified permission', () => {
		const { hasPermission } = useAuth({ roles: ['admin'], permissions: ['read'] });

		const result = hasPermission.value('read');

		expect(result).toBe(true);
	});

	it('should return false if the user does not have the specified permission', () => {
		const { hasPermission } = useAuth({ roles: ['admin'], permissions: ['read'] });

		const result = hasPermission.value('write');

		expect(result).toBe(false);
	});
});
