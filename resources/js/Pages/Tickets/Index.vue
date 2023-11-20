<script setup>
import { TicketsTable } from "@/Features/Tickets";
</script>

<template>
	<Head title="Tickets" />

	<AuthenticatedLayout>
		<template #header>
			<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
				<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Tickets</h2>
			</div>
		</template>


		<template #default>
			<TicketsTable />
		</template>
	</AuthenticatedLayout>
</template>
