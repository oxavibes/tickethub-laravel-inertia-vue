<script setup>
import { UsersTable, UsersEditModal, UsersDeleteModal } from "@/Features/Users";
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Users</h2>
		</template>


		<template #default>
			<UsersTable />
		</template>
	</AuthenticatedLayout>

	<UsersEditModal />
	<UsersDeleteModal />
</template>
