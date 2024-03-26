<script setup>
import { ref } from "vue";

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import { BaseTable, CreateTicketModal, EditTicketModal, DeleteTicketModal } from "@/Features/Tickets";

defineProps({
	tickets: {
		type: [Object],
		default: () => [],
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
	filters: {
		type: [Object],
	}
});

const headers = [
	{
		label: 'Title',
		key: 'title'
	},
	{
		label: 'Status',
		key: 'status'
	},
	{
		label: 'Priority',
		key: 'priority'
	},
	{
		label: 'Categories',
		key: 'categories'
	},
	{
		label: 'Labels',
		key: 'labels'
	},
	{
		label: 'Assigned To',
		key: 'agent'
	},
	{
		label: 'Actions',
		key: 'actions'
	}
]

const modalStore = useModalStore();
const { createTicketModalOpen, editTicketModalOpen, deleteTicketModalOpen } = storeToRefs(modalStore)

const selectedTicket = ref();

function setSelectedTicket(ticket) {
	selectedTicket.value = ticket;
};

function onCreate() {
	createTicketModalOpen.value = true
}

function onEdit(ticket) {
	editTicketModalOpen.value = true

	setSelectedTicket(ticket)
}

function onDelete(ticket) {
	deleteTicketModalOpen.value = true

	setSelectedTicket(ticket)
}

</script>

<template>

	<Head title="Tickets" />

	<AuthenticatedLayout>
		<template #default>
			<BaseTable table-id="tickets" placeholder="Search" :headers="headers" :data="tickets" route="tickets.index"
				:filters="filters" @on-create="onCreate" @on-edit="onEdit" @on-delete="onDelete">
				<template #button>
					Add
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateTicketModal :labels="labels" :categories="categories" :agents="agents" />
	<EditTicketModal :ticket="selectedTicket" :labels="labels" :categories="categories" :agents="agents" />
	<DeleteTicketModal :ticket="selectedTicket" />
</template>
