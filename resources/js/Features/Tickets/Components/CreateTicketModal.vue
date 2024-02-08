<script setup>
import { ref, computed, watch } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

import usePermission from '@/Composables/usePermission';

import { storeToRefs } from 'pinia';

import { useModalStore } from '@/Stores/modals';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'
import BaseListbox from '@/Components/Form/BaseListbox.vue';
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
	labels: [],
	categories: [],
	agent_id: null,
	status: {
		id: 'open',
		name: 'Open'
	},
	priority: {
		id: 'low',
		name: 'Low'
	},
});


const modalStore = useModalStore();
const { createTicketModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	form
		.transform((data) => ({
			...data,
			agent_id: data.agent_id?.id,
			labels: data.labels.map(({ id }) => id),
			categories: data.categories.map(({ id }) => id),
			status: data.status?.id,
			priority: data.priority?.id
		}))
		.post(route('tickets.store'), {
			preserveScroll: true,
			onSuccess: () => {
				createTicketModalOpen.value = false

				const toastStore = useToastStore()

				toastStore.add({
					type: 'success',
					message: 'Ticket created successfully',
				})

				form.reset()
			},
		})
}

const priorityOptions = [
	{ id: 'low', name: 'Low' },
	{ id: 'medium', name: 'Medium' },
	{ id: 'high', name: 'High' }
]

const statusOptions = [
	{ id: 'open', name: 'Open' },
	{ id: 'closed', name: 'Closed' },
]

const roles = computed(() => usePage().props.auth.roles);
const { hasRole } = usePermission({ roles: roles.value });
const canAssignAgent = hasRole.value('admin');

const input = ref(null);

watch(createTicketModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="createTicketModalOpen" @on-close="createTicketModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Add Ticket
			</h3>
		</template>

		<!-- Modal body -->
		<form id="create-ticket-form" class="grid gap-6" novalidate @submit.prevent="onSubmit">
			<div>
				<BaseInput ref="input" label="Title" id="create-ticket-name" type="text" v-model="form.title"
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

				<BaseListbox v-model="form.agent_id" :options="agents" :error-message="form.errors.agent_id"
					@click="form.clearErrors('agent_id')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Labels
				</div>

				<BaseListbox is-multiple v-model="form.labels" :options="labels" :error-message="form.errors.labels"
					@click="form.clearErrors('labels')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Categories
				</div>

				<BaseListbox is-multiple v-model="form.categories" :options="categories" :error-message="form.errors.categories"
					@click="form.clearErrors('categories')" />
			</div>

			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Priority
				</div>

				<BaseListbox v-model="form.priority" :options="priorityOptions" :error-message="form.errors.priority"
					@focus="form.clearErrors('priority')" />
			</div>


			<div>
				<div class="block mb-2 text-sm font-medium text-gray-900">
					Status
				</div>

				<BaseListbox v-model="form.status" :options="statusOptions" :error-message="form.errors.status"
					@click="form.clearErrors('status')" />
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="createTicketModalOpen = false">
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
