<script setup>
import TheNavbar from '@/Components/Layout/TheNavbar.vue';
</script>

<template>
	<div>
		<div class="min-h-screen bg-gray-100">
			<TheNavbar />

			<!-- Page Heading -->
			<header v-if="$slots.header">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
						<slot name="header" />
					</div>
				</div>
			</header>

			<!-- Page Content -->
			<main>
				<div class="max-w-7xl mx-auto space-y-8 sm:px-6 lg:px-8 pb-12">
					<slot />
				</div>
			</main>
		</div>
	</div>
</template>
