<script setup>
import { ref } from "vue";

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateCategoryModal, DeleteCategoryModal, EditCategoryModal } from "@/Features/Categories";

defineProps({
	categories: {
		type: [Object],
		default: () => [],
	},
	filters: {
		type: [Object],
	}
});

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
		key: "visible",
		label: "Is Visible",
	},
	{
		key: "actions",
		label: "Actions",
	},
];

const modalStore = useModalStore();
const { createCategoryModalOpen, editCategoryModalOpen, deleteCategoryModalOpen } = storeToRefs(modalStore)

const selectedCategory = ref();

function setSelectedCategory(category) {
	selectedCategory.value = category;
};

function onCreate() {
	createCategoryModalOpen.value = true
}

function onEdit(category) {
	editCategoryModalOpen.value = true

	setSelectedCategory(category)
}

function onDelete(category) {
	deleteCategoryModalOpen.value = true

	setSelectedCategory(category)
}
</script>

<template>

	<Head title="Categories" />

	<AuthenticatedLayout>
		<template #default>
			<BaseTable table-id="categories" placeholder="Search" :headers="headers" :data="categories"
				route="categories.index" :filters="filters" @on-create="onCreate" @on-edit="onEdit" @on-delete="onDelete">
				<template #button>
					Add
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateCategoryModal />
	<EditCategoryModal :category="selectedCategory" />
	<DeleteCategoryModal :category="selectedCategory" />
</template>
