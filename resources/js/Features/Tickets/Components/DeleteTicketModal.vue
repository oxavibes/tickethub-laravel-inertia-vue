<script setup>
import BaseConfirmationModal from '@/Components/Shared/BaseConfirmationModal.vue';
</script>

<template>
	<BaseConfirmationModal modal-id="deleteTicketModal">
		<template #title>
			Are you sure you want to delete this ticket?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
