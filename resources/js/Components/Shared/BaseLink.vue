<script setup>
import { computed } from 'vue'
import { cva } from "class-variance-authority";

const props = defineProps({
	isLoading: {
		type: [Boolean],
		default: false,
	},
	isDisabled: {
		type: [Boolean],
		default: false,
	},
	size: {
		type: [String],
		default: 'xs',
		validator: (value) => ['xs', 'sm', 'md', 'lg', 'xl'].includes(value),
	},
	variant: {
		type: [String],
		default: 'primary',
		validator: (value) => ['primary', 'secondary', 'danger'].includes(value),
	}
})

const computedClasses = computed(() => {
	return cva('inline-flex gap-2 items-center justify-center font-semibold tracking-widest uppercase transition duration-150 ease-in-out rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2', {
		variants: {
			variant: {
				primary: 'text-white bg-gray-800 border border-transparent',
				secondary: 'text-gray-700 bg-white border border-gray-300',
				danger: 'text-white bg-red-600 me-2',
			},
			disabled: {
				false: 'cursor-pointer',
				true: 'opacity-75 cursor-not-allowed',
			},
			size: {
				xs: 'px-3 py-2 text-xs',
				sm: 'px-4 py-2.5 text-xs',
				md: 'px-5 py-2.5 text-sm',
				lg: 'px-5 py-3 text-base',
				xl: 'px-6 py-3.5 text-base'
			},
		},
		compoundVariants: [
			{
				variant: 'primary',
				disabled: false,
				class: 'hover:bg-gray-700 focus:bg-gray-700 focus:ring-black active:bg-gray-900',
			},
			{
				variant: 'secondary',
				disabled: false,
				class: 'hover:bg-gray-50 focus:border-black focus:ring-black',
			},
			{
				variant: 'danger',
				disabled: false,
				class: 'hover:bg-red-800 focus:border-red-500 focus:ring-red-500',
			}
		],
		defaultVariants: {
			variant: 'primary',
			size: 'sm',
		},
	})({
		size: props.size,
		variant: props.variant,
		disabled: props.isDisabled
	})
});

const isLinkDisabled = computed(() => props.isDisabled || props.isLoading);
</script>

<template>
	<Link :class="computedClasses" :disabled="isLinkDisabled">
	<template v-if="isLoading">
		<svg aria-hidden="true" role="status" class="inline w-4 h-4 text-white animate-spin" viewBox="0 0 100 101" fill="none"
			xmlns="http://www.w3.org/2000/svg">
			<path
				d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
				fill="#E5E7EB" />
			<path
				d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
				fill="currentColor" />
		</svg>
		Loading...
	</template>

	<slot v-if="!isLoading && $slots.icon" name="icon" />

	<slot v-if="!isLoading" />
	</Link>
</template>

<style scoped>
</style>
