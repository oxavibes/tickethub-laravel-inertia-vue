<script setup>
import { UsersTable, UsersEditModal, UsersDeleteModal } from "@/Features/Users";
</script>

<template>
	<Head title="Users" />

	<AuthenticatedLayout>
		<template #header>
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Users</h2>
			</div>
		</template>


		<template #default>
			<UsersTable />
		</template>
	</AuthenticatedLayout>

	<UsersEditModal />
	<UsersDeleteModal />
</template>
