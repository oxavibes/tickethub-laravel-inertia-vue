<script setup>
import { CreateLabelModal, DeleteLabelModal, EditLabelModal } from "@/Features/Labels";
import BaseTable from "@/Components/Shared/BaseTable.vue";

const headers = [
	{
		key: "title",
		label: "Title",
	},
	{
		key: "slug",
		label: "Slug",
	},
	{
		key: "is_visible",
		label: "Is Visible",
	},
	{
		key: "actions",
		label: "Actions",
	},
];
</script>

<template>
	<Head title="Labels" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Labels</h2>
		</template>

		<template #default>
			<BaseTable :headers="headers" targetModalId="Label" placeholder="Search for labels">
				<template #button>
					New label
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateLabelModal />
	<EditLabelModal />
	<DeleteLabelModal />
</template>
