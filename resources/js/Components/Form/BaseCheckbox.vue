<script setup>
import { computed } from 'vue';
import { cva } from "class-variance-authority";

const model = defineModel('checked', { type: [Array, Boolean], required: true })

const props = defineProps({
	value: {
		default: null,
	},
});

const computedClasses = computed(() => {
	return cva('text-gray-700 border-gray-300 rounded shadow-sm focus:black focus:outline-black', {
		variants: {},
		compoundVariants: [],
		defaultVariants: {},
	})({})
});
</script>

<template>
	<input type="checkbox" :value="value" v-model="model" :class="computedClasses" />
</template>
