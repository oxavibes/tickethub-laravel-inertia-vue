<script setup>
import { TicketsTable } from "@/Features/Tickets";
</script>

<template>
	<Head title="Tickets" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
		</template>


		<template #default>
			<TicketsTable />
		</template>
	</AuthenticatedLayout>
</template>
