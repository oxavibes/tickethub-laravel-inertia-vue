<script setup>
import { useForm } from '@inertiajs/vue3';

import usePermission from '@/Composables/usePermission';

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseSelect from '@/Components/Form/BaseSelect.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';
import BaseTextarea from '@/Components/Form/BaseTextarea.vue';

defineProps({
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
	}
});

const form = useForm({
	title: '',
	description: '',
	labels: null,
	categories: null,
	agent_id: null,
	// status: 'open',
	priority: 'low',
	status: 'open',
});


const modalStore = useModalStore();
const { createTicketModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form.post(route('tickets.store'), {
		preserveScroll: true,
		onSuccess: () => {
			createTicketModalOpen.value = false

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

const { hasRole } = usePermission();
const canAssignAgent = hasRole.value('admin');
</script>

<template>
	<BaseModal v-model:is-open="createTicketModalOpen" @on-close="createTicketModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				New Ticket
			</h3>
		</template>

		<!-- Modal body -->
		<form id="create-ticket-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<div>
				<BaseInput label="Title" id="create-ticket-name" type="text" v-model="form.title"
					:error-message="form.errors.title" @focus="form.clearErrors('title')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Description
				</div>

				<BaseTextarea v-model="form.description" :error-message="form.errors.description"
					@focus="form.clearErrors('description')" />
			</div>

			<div v-if="canAssignAgent">
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Agent
				</div>

				<BaseSelect :options="agents" v-model="form.agent_id" :error-message="form.errors.agentId"
					@focus="form.clearErrors('agentId')" />
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
			<BaseButton @click="createTicketModalOpen = false" variant="tertiary">
				Cancel
			</BaseButton>

			<BaseButton form="create-ticket-form" type="submit" :isLoading="form.processing">
				Create
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
