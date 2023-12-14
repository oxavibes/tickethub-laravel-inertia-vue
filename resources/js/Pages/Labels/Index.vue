<script setup>
import { ref } from "vue";

import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateLabelModal, DeleteLabelModal, EditLabelModal } from "@/Features/Labels";

defineProps({
	labels: {
		type: [Object],
		default: () => [],
	},
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
		key: "is_visible",
		label: "Is Visible",
	},
	{
		key: "actions",
		label: "Actions",
	},
];

const selectedLabel = ref();

const setSelectedLabel = (label) => {
	selectedLabel.value = label;
};
</script>

<template>
	<Head title="Labels" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Labels</h2>
		</template>

		<template #default>
			<BaseTable :headers="headers" :data="labels" createModalId="createLabelModal" editModalId="editLabelModal"
				deleteModalId="deleteLabelModal" placeholder="Search for labels" @on-edit="setSelectedLabel"
				@on-delete="setSelectedLabel">
				<template #button>
					New label
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateLabelModal />
	<EditLabelModal :label="selectedLabel" />
	<DeleteLabelModal :label="selectedLabel" />
</template>
