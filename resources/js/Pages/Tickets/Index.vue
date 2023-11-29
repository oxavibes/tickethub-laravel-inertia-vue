<script setup>
import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateTicketModal, EditTicketModal, DeleteTicketModal } from "@/Features/Tickets";

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
		label: 'Category',
		key: 'category'
	},
	{
		label: 'Labels',
		key: 'labels'
	},
	{
		label: 'Assigned To',
		key: 'assigned_to'

	}
]
</script>

<template>
	<Head title="Tickets" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
		</template>

		<template #default>
			<BaseTable :headers="headers" targetModalId="Ticket" placeholder="Search for tickets">
				<template #button>
					New ticket
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateTicketModal />
	<EditTicketModal />
	<DeleteTicketModal />
</template>
