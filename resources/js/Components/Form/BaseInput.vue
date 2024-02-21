<script setup>
import { computed, ref, onMounted } from 'vue'
import { cva } from "class-variance-authority";

const model = defineModel({ type: [String, Number] })

const props = defineProps({
	label: {
		type: [String],
		default: 'Default label',
	},
	errorMessage: {
		type: [String],
		default: null,
	},
	isDisabled: {
		type: [Boolean],
		default: false,
	},
})

defineOptions({
	inheritAttrs: false,
})

const computedClasses = computed(() => {
	return cva('text-sm rounded-md block w-full p-2.5 appearance-none border shadow-sm', {
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

const input = ref(null);

defineExpose({
	input,
	focus: () => input.value.focus()
});

onMounted(() => {
	if (input.value.hasAttribute('autofocus')) {
		input.value.focus();
	}
});
</script>

<template>
	<div>
		<label :for="$attrs.id" class="block mb-1 text-sm font-medium text-gray-900">
			{{ label }}
		</label>

		<input ref="input" v-bind="$attrs" v-model="model" :class="computedClasses" :disabled="isDisabled">

		<p v-show="errorMessage" class="mt-2 text-sm text-red-600">
			{{ errorMessage }}
		</p>
	</div>
</template>

<style scoped>
</style>
