<script setup>
import TheNavbar from '@/Components/Layout/TheNavbar.vue';
import ToastList from '@/Components/Shared/ToastList.vue';
</script>

<template>
	<div class="min-h-screen overflow-hidden bg-gray-100">
		<ToastList />

		<TheNavbar />
		<!-- Page Heading -->
		<header v-if="$slots.header">
			<div class="pt-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
				<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
					<slot name="header" />
				</div>
			</div>
		</header>

		<!-- Page Content -->
		<main>
			<div class="px-6 pt-6 pb-12 mx-auto space-y-8 max-w-7xl lg:px-8">
				<slot />
			</div>
		</main>
	</div>
</template>
