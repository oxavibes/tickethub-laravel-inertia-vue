<script setup>
import { useAttrs, computed } from 'vue'

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

const emit = defineEmits(['update:modelValue'])

const computedValue = computed({
	get() {
		return props.modelValue
	},
	set(value) {
		emit('update:modelValue', value)
	},
})

defineOptions({
	inheritAttrs: false,
})

const attrs = useAttrs()

const computedClasses = computed(() => ({
	'border border-gray-300 placeholder-nickel text-sm rounded-lg block w-full p-2.5 shadow-sm': true,
	'bg-white cursor-pointer': !props.isDisabled,
	'bg-[#f9f9f9] cursor-not-allowed text-nickel': props.isDisabled,
	'border border-gray-300 focus:ring-border-gray-300 focus:border-gray-300': !props.errorMessage,
	'border border-red-500 focus:ring-red-500 focus:border-red-500': props.errorMessage,
}))

</script>

<template>
	<div>
		<label :for="attrs.id" class="block mb-2 text-sm font-medium text-gray-900">
			{{ label }}
		</label>

		<input v-bind="attrs" v-model="computedValue" :class="computedClasses" :disabled="isDisabled">

		<p v-show="errorMessage" class="text-red-600 text-sm mt-1">
			{{ errorMessage }}
		</p>
	</div>
</template>
