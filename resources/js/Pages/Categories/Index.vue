<script setup>
import BaseTable from "@/Components/Shared/BaseTable.vue";
</script>

<template>
	<Head title="Categories" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
		</template>


		<template #default>
			<BaseTable name="categories" />
		</template>
	</AuthenticatedLayout>
</template>
