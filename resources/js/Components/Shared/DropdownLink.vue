<script setup>
defineProps({
	href: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<Link :href="href"
		class="block w-full px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out text-start hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
	<slot />
	</Link>
</template>
