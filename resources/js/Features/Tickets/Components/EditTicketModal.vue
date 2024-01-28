<script setup>
import { watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseSelect from '@/Components/Form/BaseSelect.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';
import BaseTextarea from '@/Components/Form/BaseTextarea.vue';

const props = defineProps({
	ticket: {
		type: [Object],
		required: true
	},
	labels: {
		type: [Object],
		default: () => [],
	},
	categories: {
		type: [Object],
		default: () => [],
	},
	agents: {
		type: [Object],
		default: () => [],
	},
});

const form = useForm({
	...props.ticket,
	labels: props.ticket?.labels.map((label) => label.id),
	categories: props.ticket?.categories.map((category) => category.id),
});

watch(() => props.ticket, (newVal) => {
	form.defaults({
		...newVal,
		labels: props.ticket.labels.map((label) => label.id),
		categories: props.ticket.categories.map((category) => category.id),
	}).reset();
});

const modalStore = useModalStore();
const { editTicketModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form.patch(route('tickets.update', { ticket: props.ticket }), {
		preserveScroll: true,
		onSuccess: () => {
			editTicketModalOpen.value = false

			form.reset()
		},
	})
}

const priorityOptions = [
	{ value: 'low', label: 'Low' },
	{ value: 'medium', label: 'Medium' },
	{ value: 'high', label: 'High' }
]

const statusOptions = [
	{ value: 'open', label: 'Open' },
	{ value: 'closed', label: 'Closed' },
]
</script>

<template>
	<BaseModal v-model:is-open="editTicketModalOpen" @on-close="editTicketModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				New Ticket
			</h3>
		</template>

		<!-- Modal body -->
		<form id="edit-ticket-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<div>
				<BaseInput label="Title" id="edit-ticket-name" type="text" v-model="form.title" :error-message="form.errors.title"
					@focus="form.clearErrors('title')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Description
				</div>

				<BaseTextarea v-model="form.description" :error-message="form.errors.description"
					@focus="form.clearErrors('description')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Agent
				</div>

				<BaseSelect :options="agents" v-model="form.agent_id" :error-message="form.errors.agent_id"
					@focus="form.clearErrors('agent_id')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Labels
				</div>

				<BaseSelect is-multiple :options="labels" v-model="form.labels" :error-message="form.errors.labels"
					@focus="form.clearErrors('labels')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Categories
				</div>

				<BaseSelect is-multiple :options="categories" v-model="form.categories" :error-message="form.errors.categories"
					@focus="form.clearErrors('categories')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Priority
				</div>

				<BaseSelect :options="priorityOptions" v-model="form.priority" :error-message="form.errors.priority"
					@focus="form.clearErrors('priority')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Status
				</div>

				<BaseSelect :options="statusOptions" v-model="form.status" :error-message="form.errors.status"
					@focus="form.clearErrors('status')" />
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton form="edit-ticket-form" type="submit" :isLoading="form.processing">
				Save
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
