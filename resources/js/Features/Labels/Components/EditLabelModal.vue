<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';

import { useModalStore } from '@/Stores/modals';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseRadio from '@/Components/Form/BaseRadio.vue';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

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

let form = useForm({
	...props.label
});

watch(() => props.label, (newVal) => {
	form.defaults({ ...newVal }).reset();
});

const modalStore = useModalStore();
const { editLabelModalOpen } = storeToRefs(modalStore);

function onSubmit() {
	const uri = route('labels.update', { label: props.label })

	form.patch(uri, {
		preserveScroll: true,
		onSuccess: () => {
			editLabelModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Label updated successfully',
			})

			form.reset()
		},
	})
}

const visibilityOptions = [
	{ id: 'edit-label-visible', value: true, label: 'Yes' },
	{ id: 'edit-label-hidden', value: false, label: 'No' },
]

const input = ref(null);
watch(editLabelModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="editLabelModalOpen" @on-close="editLabelModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Edit label
			</h3>
		</template>

		<!-- Modal body -->
		<form id="editLabelForm" class="grid gap-6" novalidate @submit.prevent="onSubmit">

			<BaseInput ref="input" label="Title" id="editLabelTitle" type="text" v-model="form.title"
				:error-message="form.errors.title" @focus="form.clearErrors('title')" />

			<div>
				<label class="block mb-2 text-sm font-medium text-gray-900">
					Is Visible?
				</label>

				<div class="flex flex-wrap gap-6">
					<BaseRadio v-for="option in visibilityOptions" v-model="form.visible" :option="option" />

					<p v-show="form.errors.visible" class="mt-2 text-sm text-red-600">
						{{ form.errors.visible }}
					</p>
				</div>

			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="editLabelModalOpen = false">
				Cancel
			</BaseButton>

			<BaseButton form="editLabelForm" type="submit" :isLoading="form.processing">
				Save
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
