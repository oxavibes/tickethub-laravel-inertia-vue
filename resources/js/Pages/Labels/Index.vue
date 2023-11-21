<script setup>
import BaseTable from "@/Components/Shared/BaseTable.vue";
</script>

<template>
	<Head title="Labels" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Labels</h2>
		</template>


		<template #default>
			<BaseTable name="labels" />
		</template>
	</AuthenticatedLayout>
</template>
