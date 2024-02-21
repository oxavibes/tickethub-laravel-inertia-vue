<script setup>
import { computed } from 'vue'
import { cva } from "class-variance-authority";

const model = defineModel({ type: [String, Number] })

const props = defineProps({
	options: {
		type: Array,
		default: () => [],
	},
	defaultOption: {
		type: [String],
		default: 'Select an option',
	},
	isDisabled: {
		type: [Boolean],
		default: false,
	},
	errorMessage: {
		type: [String],
	}
})

defineOptions({
	inheritAttrs: false,
})

const selectedOption = computed(() => {
	return props.options.find(option => option.value == model.value)
})

const computedSelectClasses = computed(() => {
	return cva('placeholder-nickel text-sm rounded-md block w-full p-2.5 appearance-none border', {
		variants: {
			selectedOption: 'text-black'
		},
		compoundVariants: [
			{
				disabled: true,
				error: false,
				class: 'text-nickel bg-persian cursor-not-allowed bg-gray-50 border-gray-300 text-gray-900'
			},
			{
				disabled: true,
				error: true,
				class: 'text-nickel bg-persian cursor-not-allowed bg-gray-50 border-gray-300 text-gray-900'
			},
			{
				disabled: false,
				error: true,
				class: 'text-red-500 border-red-500 focus:ring-red-500 focus:border-red-500 outline-red-500'
			},
			{
				disabled: false,
				error: false,
				class: 'bg-white cursor-pointer border-gray-300 focus:ring-black focus:border-black'
			}
		],
		defaultVariants: {},
	})({
		error: !!props.errorMessage,
		disabled: props.isDisabled,
		selectedOption: !!selectedOption.value,
	})
});

function onChange(event) {
	model.value = event.target.value
}
</script>

<template>
	<select v-bind="$attrs" :class="computedSelectClasses" :disabled="isDisabled" @change="onChange">
		<option value="" disabled :selected="selectedOption == null">
			{{ defaultOption }}
		</option>

		<option v-for="option in options" :key="option.value" :value="option.value"
			:selected="selectedOption?.value == option.value">
			{{ option.label }}
		</option>
	</select>

	<p v-show="errorMessage" class="mt-1 text-sm text-red-600">
		{{ errorMessage }}
	</p>
</template>

<style scoped>
</style>
