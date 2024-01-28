<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Modals/BaseConfirmationModal.vue';

const props = defineProps({
	ticket: {
		type: [Object],
		required: true,
		default: () => ({})
	},
})

const form = useForm({});

const modalStore = useModalStore();
const { deleteTicketModalOpen } = storeToRefs(modalStore);

function onConfirm() {
	const uri = route('tickets.destroy', { ticket: props.ticket })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteTicketModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseConfirmationModal v-model:is-open="deleteTicketModalOpen" :is-loading="form.processing" @on-confirm="onConfirm"
		@on-close="deleteTicketModalOpen = false">
		<template #title>
			Are you sure you want to delete this ticket?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
