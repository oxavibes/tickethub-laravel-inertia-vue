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
	category: {
		type: [Object],
		required: true,
		default: () => ({
			title: '',
			visible: false
		})
	},
})

const form = useForm({
	...props.category
});

watch(() => props.category, (newVal) => {
	form.defaults({ ...newVal }).reset();
});

const modalStore = useModalStore();
const { editCategoryModalOpen } = storeToRefs(modalStore);

function onSubmit() {
	const uri = route('categories.update', { category: props.category })

	form.patch(uri, {
		preserveScroll: true,
		onSuccess: () => {
			editCategoryModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Category updated successfully',
			})

			form.reset()
		},
	})
}

const visibilityOptions = [
	{ id: 'edit-category-visible', value: true, label: 'Yes' },
	{ id: 'edit-category-hidden', value: false, label: 'No' },
]

const input = ref(null);

watch(editCategoryModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="editCategoryModalOpen" @on-close="editCategoryModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Edit category
			</h3>
		</template>

		<!-- Modal body -->
		<form id="edit-label-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">

			<BaseInput ref="input" label="Title" id="edit-category-title" type="text" v-model="form.title"
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
			<BaseButton variant="secondary" @click="editCategoryModalOpen = false">
				Cancel
			</BaseButton>

			<BaseButton form="edit-label-form" type="submit" :isLoading="form.processing">
				Save
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
