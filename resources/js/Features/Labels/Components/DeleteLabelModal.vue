<script setup>
import { onBeforeMount } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseConfirmationModal from '@/Components/Shared/BaseConfirmationModal.vue';

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

const modalId = 'deleteLabelModal';

const form = useForm({});

const modalStore = useModalStore();
const { closeModal } = modalStore;
const { modals } = storeToRefs(modalStore);

function onConfirm() {
	const uri = route('labels.destroy', { label: props.label })

	form.delete(uri, {
		preserveScroll: true,
		// preserveState: false,
		onSuccess: () => {
			closeModal(modalId);

			form.reset()
		},
	})
}

onBeforeMount(() => {
	modals[modalId] = false
});
</script>

<template>
	<BaseConfirmationModal :modalId="modalId" v-model:is-open="modals[modalId]" @on-confirm="onConfirm"
		@on-close="closeModal(modalId)">
		<template #title>
			Are you sure you want to delete this label?
		</template>
	</BaseConfirmationModal>
</template>

<style scoped>
</style>
