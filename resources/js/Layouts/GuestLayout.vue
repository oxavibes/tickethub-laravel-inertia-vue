<script setup>
import TheLogo from '@/Components/Layout/TheLogo.vue';
</script>

<template>
	<div class="flex flex-col items-center min-h-screen px-6 pt-6 bg-gray-100 sm:justify-center sm:pt-0">
		<TheLogo class="w-20 h-20 mb-2" />

		<div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white rounded-lg shadow-md sm:max-w-md">
			<slot />
		</div>
	</div>
</template>
