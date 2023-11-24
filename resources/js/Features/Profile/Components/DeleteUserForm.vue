<script setup>
import DangerButton from '@/Components/Buttons/DangerButton.vue';
import DeleteUserModal from '@/Features/Profile/Components/DeleteUserModal.vue';
</script>

<template>
	<section class="space-y-6">
		<header>
			<h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

			<p class="mt-1 text-sm text-gray-600">
				Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
				your account, please download any data or information that you wish to retain.
			</p>
		</header>

		<DangerButton data-modal-target="deleteUserModal" data-modal-show="deleteUserModal">
			Delete Account
		</DangerButton>

		<DeleteUserModal />
	</section>
</template>
