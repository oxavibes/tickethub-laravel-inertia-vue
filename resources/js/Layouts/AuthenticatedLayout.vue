<script setup>
import TheNavbar from '@/Components/Layout/TheNavbar.vue';
import ToastList from '@/Components/Shared/ToastList.vue';
</script>

<template>
	<div>
		<ToastList />

		<div class="min-h-screen bg-gray-100">
			<TheNavbar />
			<!-- Page Heading -->
			<header v-if="$slots.header">
				<div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
					<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
						<slot name="header" />
					</div>
				</div>
			</header>

			<!-- Page Content -->
			<main>
				<div class="pb-12 mx-auto space-y-8 max-w-7xl sm:px-6 lg:px-8">
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>
