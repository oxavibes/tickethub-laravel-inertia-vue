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

const form = useForm({
	title: '',
	visible: true,
});

const modalStore = useModalStore();
const { createCategoryModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form.post(route('categories.store'), {
		preserveScroll: true,
		onSuccess: () => {
			createCategoryModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Category created successfully',
			})

			form.reset()
		},
	})
}

const visibilityOptions = [
	{ id: 'create-category-visible', value: true, label: 'Yes' },
	{ id: 'create-category-hidden', value: false, label: 'No' },
]

const input = ref(null);

watch(createCategoryModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="createCategoryModalOpen" @on-close="createCategoryModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Add category
			</h3>
		</template>

		<!-- Modal body -->
		<form id="create-category-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<BaseInput ref="input" label="Title" id="create-label-name" type="text" v-model="form.title"
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
			<BaseButton variant="secondary" @click="createCategoryModalOpen = false">
				Cancel
			</BaseButton>

			<BaseButton form="create-category-form" type="submit" :isLoading="form.processing">
				Create
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
