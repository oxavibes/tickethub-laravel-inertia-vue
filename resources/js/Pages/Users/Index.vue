<script setup>
import { ref } from "vue";

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateUserModal, EditUserModal, DeleteUserModal } from "@/Features/Users";

defineProps({
	users: {
		type: [Object],
		default: () => [],
	},
	filters: {
		type: [Object],
	}
});

const headers = [
	{ label: 'Name', key: 'name' },
	{ label: 'Email', key: 'email' },
	{ label: 'Role', key: 'roles' },
	{ label: 'Actions', key: 'actions' },
]

const modalStore = useModalStore();
const { createUserModalOpen, editUserModalOpen, deleteUserModalOpen } = storeToRefs(modalStore)

const selectedUser = ref();

function setSelectedUser(user) {
	selectedUser.value = user;
};

function onCreate() {
	createUserModalOpen.value = true
}

function onEdit(user) {
	editUserModalOpen.value = true

	setSelectedUser(user)
}

function onDelete(user) {
	deleteUserModalOpen.value = true

	setSelectedUser(user)
}
</script>

<template>

	<Head title="Users" />

	<AuthenticatedLayout>
		<template #default>
			<BaseTable table-id="users" placeholder="Search" :headers="headers" :data="users" route="users.index"
				:filters="filters" @on-create="onCreate" @on-edit="onEdit" @on-delete="onDelete">
				<template #button>
					Add
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateUserModal />
	<EditUserModal :user="selectedUser" />
	<DeleteUserModal :user="selectedUser" />
</template>
