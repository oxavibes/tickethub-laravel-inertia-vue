<script setup>
import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateUserModal, EditUserModal, DeleteUserModal } from "@/Features/Users";

const headers = [
	{ label: 'Name', key: 'name' },
	{ label: 'Email', key: 'email' },
	{ label: 'Role', key: 'role' },
	{ label: 'Actions', key: 'actions' },
]
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Users</h2>
		</template>

		<template #default>
			<BaseTable :headers="headers" targetModalId="User" placeholder="Search for users">
				<template #button>
					New user
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateUserModal />
	<EditUserModal />
	<DeleteUserModal />
</template>
