<script setup>
import { computed } from 'vue';

const props = defineProps({
	href: {
		type: String,
		required: true,
	},
	active: {
		type: Boolean,
	},
});

const computedClasses = computed(() => ({
	"flex items-center px-1 pt-1 gap-2 border-b-2 transition duration-150 ease-in-out": true,
	"border-black text-gray-900 focus:border-black;": props.active,
	"border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300": !props.active
}));
</script>

<template>
	<Link :href="href" :class="computedClasses">
	<slot />
	</Link>
</template>

<style scoped></style>
