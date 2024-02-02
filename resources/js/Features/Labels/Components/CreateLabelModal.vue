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
const { createLabelModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form.post(route('labels.store'), {
		preserveScroll: true,
		onSuccess: () => {
			createLabelModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Label edited successfully',
			})

			form.reset()
		},
	})
}

const visibilityOptions = [
	{ id: 'create-label-visible', value: true, label: 'Yes' },
	{ id: 'create-label-hidden', value: false, label: 'No' },
]

const input = ref(null);

watch(createLabelModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="createLabelModalOpen" @on-close="createLabelModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Add label
			</h3>
		</template>

		<!-- Modal body -->
		<form id="create-label-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<BaseInput ref="input" autofocus label="Title" id="create-label-name" type="text" v-model="form.title"
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
			<BaseButton variant="secondary" @click="createLabelModalOpen = false">
				Cancel
			</BaseButton>

			<BaseButton form="create-label-form" type="submit" :isLoading="form.processing">
				Create
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
