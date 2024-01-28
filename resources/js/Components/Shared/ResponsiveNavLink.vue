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
	"block w-full ps-3 pe-4 py-2 border-l-4 text-start text-base text-medium transition duration-150 ease-in-out": true,
	"border-black text-black bg-gray-100 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700": props.active,
	"border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300": !props.active
}));
</script>

<template>
	<Link :href="href" :class="computedClasses">
	<slot />
	</Link>
</template>
