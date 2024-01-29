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

const proxyChecked = computed({
	get() {
		return props.checked;
	},

	set(val) {
		emit('update:checked', val);
	},
});
</script>

<template>
	<input type="checkbox" :value="value" v-model="proxyChecked"
		class="rounded border-gray-300 text-gray-700 shadow-sm focus:black focus:outline-black" />
</template>
