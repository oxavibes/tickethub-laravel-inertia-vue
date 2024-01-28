<script setup>
import { computed } from 'vue'
import { cva } from "class-variance-authority";

const props = defineProps({
	modelValue: {
		type: [Number, String],
	},
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
	isMultiple: {
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

const emit = defineEmits(['update:modelValue'])

const computedModelValue = computed({
	get() {
		return props.modelValue
	},
	set(value) {
		if (props.isMultiple) {
			emit('update:modelValue', [value])
		}

		else {
			emit('update:modelValue', value)
		}
	},
})

const selectedOption = computed(() => {
	return props.options.find(option => option.value == computedModelValue.value)
})

const computedSelectClasses = computed(() => {
	const defaultClass = "placeholder-nickel text-sm rounded-md block w-full p-2.5 appearance-none cursor-pointer border border-gray-300 focus:ring-black focus:border-black";
	const disabledClass = "text-nickel bg-persian cursor-not-allowed";
	const errorClass = "border-red-500 focus:ring-red-500 focus:border-red-500";
	const selectedOptionClass = "text-black";

	return cva(defaultClass, {
		variants: {
			disabled: {
				true: disabledClass,
			},
			error: {
				true: errorClass,
			},
			selectedOption: {
				true: selectedOptionClass
			}
		},
		compoundVariants: [],
		defaultVariants: {},
	})({
		error: !!props.errorMessage,
		disabled: props.isDisabled,
		selectedOption: !!selectedOption.value,
	})
});

function onChange(event) {
	computedModelValue.value = event.target.value
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

	<p v-show="errorMessage" class="text-red-600 text-sm mt-1">
		{{ errorMessage }}
	</p>
</template>

<style scoped>
</style>
