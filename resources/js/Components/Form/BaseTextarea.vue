<script setup>
import { computed } from 'vue'
import { cva } from "class-variance-authority";

const model = defineModel({ type: [String] })

const props = defineProps({
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

const computedClasses = computed(() => {
	return cva('block appearance-none resize-none p-2.5 w-full text-sm rounded-md shadow-sm', {
		variants: {},
		compoundVariants: [
			{
				disabled: true,
				error: false,
				class: 'text-nickel bg-persian cursor-not-allowed bg-gray-50 border-gray-300 text-gray-900'
			},
			{
				disabled: true,
				error: true,
				class: 'text-nickel bg-persian cursor-not-allowed bg-gray-50 border-gray-300'
			},
			{
				disabled: false,
				error: true,
				class: 'text-red-500 border-red-500 outline-red-500 focus:ring-red-500 focus:border-red-500'
			},
			{
				disabled: false,
				error: false,
				class: 'text-gray-900 bg-white border-gray-300 cursor-pointer focus:ring-black focus:border-black'
			}
		],
		defaultVariants: {},
	})({
		error: !!props.errorMessage,
		disabled: props.isDisabled
	})
});
</script>


<template>
	<textarea v-bind="$attrs" v-model="model" rows="6" :class="computedClasses" :disabled="isDisabled" />

	<p v-show="errorMessage" class="mt-1 text-sm text-red-600">
		{{ errorMessage }}
	</p>
</template>
