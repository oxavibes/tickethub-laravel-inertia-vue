<script setup>
import { watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

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

			form.reset()
		},
	})
}
</script>

<template>
	<BaseModal v-model:is-open="editCategoryModalOpen" @on-close="editCategoryModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				Edit category
			</h3>
		</template>

		<!-- Modal body -->
		<form id="edit-label-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">

			<BaseInput label="Title" id="edit-category-title" type="text" v-model="form.title"
				:error-message="form.errors.title" @focus="form.clearErrors('title')" />

			<div>
				<label class="block mb-2 text-sm font-medium text-gray-900">
					Is Visible?
				</label>

				<div class="flex flex-wrap gap-6">
					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded">
							<input v-model="form.visible" id="edit-label-visible-true" type="radio" :value="true"
								name="edit-label-visible"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
							<label for="edit-label-visible-true" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">True</label>
						</div>
					</div>

					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded">
							<input v-model="form.visible" id="edit-label-visible-false" type="radio" :value="false"
								name="edit-label-visible"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
							<label for="edit-label-visible-false"
								class="w-full py-4 ms-2 text-sm font-medium text-gray-900">False</label>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton form="edit-label-form" type="submit" :isLoading="form.processing">
				Save
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
