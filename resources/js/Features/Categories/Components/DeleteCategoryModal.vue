<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Shared/BaseConfirmationModal.vue';

const props = defineProps({
	category: {
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
const { deleteCategoryModalOpen } = storeToRefs(modalStore);

function onConfirm() {
	const uri = route('categories.destroy', { category: props.category })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteCategoryModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseConfirmationModal v-model:is-open="deleteCategoryModalOpen" @on-confirm="onConfirm"
		@on-close="deleteCategoryModalOpen = false">
		<template #title>
			Are you sure you want to delete this category?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
