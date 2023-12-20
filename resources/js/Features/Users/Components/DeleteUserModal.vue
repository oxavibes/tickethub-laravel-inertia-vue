<script setup>
import { storeToRefs } from 'pinia'
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Shared/BaseConfirmationModal.vue';

const modalStore = useModalStore();
const { closeModal } = modalStore;
const { isModalOpen } = storeToRefs(modalStore)
</script>

<template>
	<BaseConfirmationModal modal-id="deleteUserModal" :is-open="isModalOpen('deleteUserModal')"
		@on-close="closeModal('deleteUserModal')">
		<template #title>
			Are you sure you want to delete this user?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
