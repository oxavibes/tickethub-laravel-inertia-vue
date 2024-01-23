<script setup>
import { computed } from 'vue'

const props = defineProps({
	modelValue: {
		type: [String],
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

const emit = defineEmits(['update:modelValue'])

const computedModelValue = computed({
	get() {
		return props.modelValue
	},
	set(value) {
		emit('update:modelValue', value)
	},
})

const computedSelectClasses = computed(() => ({
	'block resize-none p-2.5 w-full text-sm text-black bg-white rounded-lg shadow-sm': true,
	'text-nickel bg-persian cursor-not-allowed': props.isDisabled,
	'border border-red-500 focus:ring-red-500 focus:border-red-500': props.errorMessage,
	'border border-gray-300 focus:ring-black focus:border-black cursor-pointer': !props.errorMessage || !props.isDisabled,
}))
</script>


<template>
	<textarea v-bind="$attrs" v-model="computedModelValue" rows="6" :class="computedSelectClasses" :disabled="isDisabled" />

	<p v-show="errorMessage" class="text-red-600 text-sm mt-1">
		{{ errorMessage }}
	</p>
</template>
