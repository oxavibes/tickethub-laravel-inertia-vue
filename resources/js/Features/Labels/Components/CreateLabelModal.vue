<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseModal from '@/Components/Shared/BaseModal.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';

const form = useForm({
	title: '',
	visible: true,
});

const modalStore = useModalStore();
const { createLabelModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form.post(route('labels.store'), {
		preserveScroll: true,
		onSuccess: () => {
			createLabelModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseModal v-model:is-open="createLabelModalOpen" @on-close="createLabelModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				New label
			</h3>
		</template>

		<!-- Modal body -->
		<form id="create-label-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<BaseInput label="Title" id="create-label-name" type="text" v-model="form.title" :error-message="form.errors.title"
				@focus="form.clearErrors('title')" />

			<div>
				<label class="block mb-2 text-sm font-medium text-gray-900">
					Is Visible?
				</label>

				<div class="flex flex-wrap gap-6">
					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded">
							<input v-model="form.visible" id="create-label-visible-true" type="radio" :value="true"
								name="create-label-visible"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
							<label for="create-label-visible-true"
								class="w-full py-4 ms-2 text-sm font-medium text-gray-900">True</label>
						</div>
					</div>

					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded">
							<input v-model="form.visible" id="create-label-visible-false" type="radio" :value="false"
								name="create-label-visible"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
							<label for="create-label-visible-false"
								class="w-full py-4 ms-2 text-sm font-medium text-gray-900">False</label>
						</div>
					</div>
				</div>
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<PrimaryButton form="create-label-form" type="submit" :isLoading="form.processing">
				Create
			</PrimaryButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
