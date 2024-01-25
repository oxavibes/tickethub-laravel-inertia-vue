<script setup>
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseRadio from '@/Components/Form/BaseRadio.vue';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

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

const visibilityOptions = [
	{ id: 'create-label-visible', value: true, label: 'True' },
	{ id: 'create-label-hidden', value: false, label: 'False' },
]
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
					<BaseRadio v-for="option in visibilityOptions" v-model="form.visible" :option="option" />

					<p v-show="form.errors.visible" class="text-red-600 text-sm mt-2">
						{{ form.errors.visible }}
					</p>
				</div>
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton form="create-label-form" type="submit" :isLoading="form.processing">
				Create
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
