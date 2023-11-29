<script setup>
import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateCategoryModal, DeleteCategoryModal, EditCategoryModal } from "@/Features/Categories";

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
	<Head title="Categories" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
		</template>

		<template #default>
			<BaseTable :headers="headers" targetModalId="Category" placeholder="Search for categories">
				<template #button>
					New category
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateCategoryModal />
	<EditCategoryModal />
	<DeleteCategoryModal />
</template>
