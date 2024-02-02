<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';

import { useModalStore } from '@/Stores/modals';
import { useToastStore } from '@/Stores/toast';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

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

function onDelete() {
	const uri = route('tickets.destroy', { ticket: props.ticket })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteTicketModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Ticket deleted successfully',
			})

			form.reset()
		},
	})
}
</script>

<template>
	<BaseModal v-model:is-open="deleteTicketModalOpen" @on-close="deleteTicketModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Delete ticket
			</h3>
		</template>

		<!-- Modal body -->
		<div>
			<p class="text-sm text-gray-600">
				This action cannot be undone. Do you want to proceed with the deletion?
			</p>

		</div>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="deleteTicketModalOpen = false"> Cancel </BaseButton>

			<BaseButton @click="onDelete" variant="danger" class="ms-3" :is-loading="form.processing">
				Delete
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
