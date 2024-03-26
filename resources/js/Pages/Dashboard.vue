<script setup>
defineProps({
	totalUsers: {
		type: Number,
		default: 0,
	},
	totalLabels: {
		type: Number,
		default: 0,
	},
	totalCategories: {
		type: Number,
		default: 0,
	},
	totalTickets: {
		type: Number,
		default: 0,
	},
})
</script>

<template>

	<Head title="Dashboard" />

	<AuthenticatedLayout>
		<!-- <template #header>
			<h2 class="p-6 text-2xl font-bold tracking-tight text-gray-950 sm:text-3xl">Stats</h2>
		</template> -->

		<template #default>
			<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
				<div class="relative p-6 bg-white shadow-sm fi-wi-stats-overview-stat rounded-xl ring-1 ring-gray-950/5">
					<div class="grid gap-y-2">
						<div class="flex items-center gap-x-2">
							<span class="text-sm font-medium text-gray-500 dark:text-gray-400">
								Total Users
							</span>
						</div>

						<div class="text-3xl font-semibold tracking-tight text-gray-950">
							{{ totalUsers }}
						</div>
					</div>
				</div>

				<div class="relative p-6 bg-white shadow-sm fi-wi-stats-overview-stat rounded-xl ring-1 ring-gray-950/5">
					<div class="grid gap-y-2">
						<div class="flex items-center gap-x-2">
							<span class="text-sm font-medium text-gray-500 dark:text-gray-400">
								Total Labels
							</span>
						</div>

						<div class="text-3xl font-semibold tracking-tight text-gray-950">
							{{ totalLabels }}
						</div>
					</div>
				</div>

				<div class="relative p-6 bg-white shadow-sm fi-wi-stats-overview-stat rounded-xl ring-1 ring-gray-950/5">
					<div class="grid gap-y-2">
						<div class="flex items-center gap-x-2">
							<span class="text-sm font-medium text-gray-500 dark:text-gray-400">
								Total Categories
							</span>
						</div>

						<div class="text-3xl font-semibold tracking-tight text-gray-950">
							{{ totalCategories }}
						</div>
					</div>
				</div>

				<div class="relative p-6 bg-white shadow-sm fi-wi-stats-overview-stat rounded-xl ring-1 ring-gray-950/5">
					<div class="grid gap-y-2">
						<div class="flex items-center gap-x-2">
							<span class="text-sm font-medium text-gray-500 dark:text-gray-400">
								Total Tickets
							</span>
						</div>

						<div class="text-3xl font-semibold tracking-tight text-gray-950">
							{{ totalTickets }}
						</div>
					</div>
				</div>
			</div>
		</template>

	</AuthenticatedLayout>
</template>
