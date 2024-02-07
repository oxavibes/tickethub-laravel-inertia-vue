<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:checked']);

const props = defineProps({
	checked: {
		type: [Array, Boolean],
		required: true,
	},
	value: {
		default: null,
	},
});

const computedModelValue = computed({
	get() {
		return props.checked;
	},

	set(val) {
		emit('update:checked', val);
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
	<input type="checkbox" :value="value" v-model="computedModelValue" :class="computedClasses" />
</template>
