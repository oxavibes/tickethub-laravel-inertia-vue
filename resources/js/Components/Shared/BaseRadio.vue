<script setup>
import { computed } from 'vue';

const props = defineProps({
	selected: {
		type: [String, Number],
		required: true,
	},
	option: {
		type: [Object],
		required: true,
	},
})

const emit = defineEmits(["update:selected"]);

const computedSelected = computed({
	get() {
		return props.selected
	},
	set(value) {
		emit('update:selected', value)
	},
})
</script>

<template>
	<div class="flex-1">
		<div class="flex items-center px-4 border border-gray-200 rounded">
			<input v-model="computedSelected" :id="option.id" type="radio" :value="option.value"
				class="w-4 h-4 text-gray-800 bg-gray-100 border-gray-300 focus:ring-gray-800 focus:ring-2">
			<label :for="option.id" class="w-full py-4 ms-2 text-sm font-medium text-gray-900">
				{{ option.label }}
			</label>
		</div>
	</div>
</template>

<style scoped>
</style>
