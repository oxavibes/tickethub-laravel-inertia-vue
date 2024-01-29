<script setup>
import { computed, useAttrs, ref, onMounted } from 'vue'
import { cva } from "class-variance-authority";

const props = defineProps({
	label: {
		type: [String],
		default: 'Default label',
	},
	modelValue: {
		type: [String, Number],
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

const attrs = useAttrs()

const emit = defineEmits(['update:modelValue'])

const computedModelValue = computed({
	get() {
		return props.modelValue
	},
	set(value) {
		emit('update:modelValue', value)
	},
})

const computedClasses = computed(() => {
	return cva('bg-white cursor-pointer placeholder-nickel text-sm rounded-lg block w-full p-2.5 shadow-sm border border-gray-300 focus:ring-black focus:border-black', {
		variants: {
			disabled: {
				true: 'bg-persian cursor-not-allowed text-nickel',
			},
			error: {
				true: 'border-red-500 focus:ring-red-500 focus:border-red-500',
			}
		},
		compoundVariants: [],
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
		<label :for="attrs.id" class="block mb-1 text-sm font-medium text-gray-900">
			{{ label }}
		</label>

		<input ref="input" v-bind="attrs" v-model="computedModelValue" :class="computedClasses" :disabled="isDisabled">

		<p v-show="errorMessage" class="mt-2 text-sm text-red-600">
			{{ errorMessage }}
		</p>
	</div>
</template>

<style scoped>
</style>
