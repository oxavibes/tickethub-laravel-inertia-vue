<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Modals/BaseConfirmationModal.vue';

const props = defineProps({
	label: {
		type: [Object],
		required: true,
		default: () => ({
			title: '',
			visible: false
		})
	},
})

const form = useForm({});

const modalStore = useModalStore();
const { deleteLabelModalOpen } = storeToRefs(modalStore);

function onConfirm() {
	const uri = route('labels.destroy', { label: props.label })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteLabelModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseConfirmationModal v-model:is-open="deleteLabelModalOpen" :is-loading="form.processing" @on-confirm="onConfirm"
		@on-close="deleteLabelModalOpen = false">
		<template #title>
			Are you sure you want to delete this label?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
