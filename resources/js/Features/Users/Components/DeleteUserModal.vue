<script setup>
import { useForm } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia'
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Modals/BaseConfirmationModal.vue';

const props = defineProps({
	user: {
		type: [Object],
		required: true,
		default: () => ({
			name: '',
			email: '',
			role: '',
		})
	},
})

const form = useForm({});

const modalStore = useModalStore();
const { deleteUserModalOpen } = storeToRefs(modalStore);

function onConfirm() {
	const uri = route('users.destroy', { user: props.user })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteUserModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseConfirmationModal v-model:is-open="deleteUserModalOpen" :is-loading="form.processing" @on-confirm="onConfirm"
		@on-close="deleteUserModalOpen = false">
		<template #title>
			Are you sure you want to delete this user?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
