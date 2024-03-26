<script setup>
import { ref } from "vue";

import { storeToRefs } from 'pinia';
import { useModalStore } from '@/Stores/modals';

import BaseTable from "@/Components/Shared/BaseTable.vue";
import { CreateLabelModal, DeleteLabelModal, EditLabelModal } from "@/Features/Labels";

defineProps({
	labels: {
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
const { createLabelModalOpen, editLabelModalOpen, deleteLabelModalOpen } = storeToRefs(modalStore)

const selectedLabel = ref();

function setSelectedLabel(label) {
	selectedLabel.value = label;
};

function onCreate() {
	createLabelModalOpen.value = true
}

function onEdit(label) {
	editLabelModalOpen.value = true

	setSelectedLabel(label)
}

function onDelete(label) {
	deleteLabelModalOpen.value = true

	setSelectedLabel(label)
}
</script>

<template>

	<Head title="Labels" />

	<AuthenticatedLayout>
		<template #default>
			<BaseTable table-id="labels" placeholder="Search" :headers="headers" :data="labels" route="labels.index"
				:filters="filters" @on-create="onCreate" @on-edit="onEdit" @on-delete="onDelete">
				<template #button>
					Add
				</template>
			</BaseTable>
		</template>
	</AuthenticatedLayout>

	<CreateLabelModal />
	<EditLabelModal :label="selectedLabel" />
	<DeleteLabelModal :label="selectedLabel" />
</template>
