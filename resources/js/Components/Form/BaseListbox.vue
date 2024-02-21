<script setup>
import { computed } from 'vue'
import { cva } from 'class-variance-authority';
import {
	Listbox,
	ListboxButton,
	ListboxOptions,
	ListboxOption,
} from '@headlessui/vue'

const model = defineModel({ type: [Array, String, Number] })

const props = defineProps({
	options: {
		type: [Array],
		required: true,
		default: () => [],
	},
	errorMessage: {
		type: [String],
		default: null
	},
	isMultiple: {
		type: [Boolean],
		default: false,
	},
	isDisabled: {
		type: [Boolean],
		default: false,
	},
})

defineOptions({
	inheritAttrs: false,
})

const isEmpty = computed(() => {
	if (props.isMultiple) {
		return model.value?.length == 0
	}

	return !model.value
})

const computedLabel = computed(() => {
	if (isEmpty.value) return "Please select an option"

	if (props.isMultiple) {
		return model.value?.map((x) => x.name).join(", ")
	}

	return model.value?.name
})

const computedListboxButtonClasses = computed(() => {
	return cva('relative w-full max-w-[511px] rounded-md border cursor-default py-2.5 pl-3 pr-10 text-left transition duration-150 ease-in-out text-sm focus:ring-1', {
		variants: {
			empty: {
				true: 'text-gray-400',
			}
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
		empty: isEmpty.value,
		error: !!props.errorMessage,
		disabled: props.isDisabled,
	})
});

const computedListboxOptionClasses = computed(() => {
	return (isSelected, isActive) => ({
		'relative py-2 pl-2 pr-4 mr-px cursor-default select-none': true,
		'bg-gray-700 text-white': isSelected && isActive,
		'bg-gray-200': isSelected && !isActive,
		'text-white bg-gray-700': !isSelected && isActive,
		'text-gray-900': !isSelected && !isActive
	})
})

</script>

<template>
	<Listbox as="div" v-bind="$attrs" by="id" :disabled="isDisabled" :multiple="isMultiple" v-model="model"
		v-slot="{ open: isOpen }">
		<div class="relative">
			<span class="inline-block w-full rounded-md shadow-sm">
				<ListboxButton :class="computedListboxButtonClasses">
					<span class="block truncate">
						{{ computedLabel }}
					</span>
					<span class="absolute inset-y-0 right-0 flex items-center pr-2 ml-3 pointer-events-none">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4 text-gray-400"
							aria-hidden="true">
							<path fill-rule="evenodd"
								d="M5.22 10.22a.75.75 0 0 1 1.06 0L8 11.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-2.25 2.25a.75.75 0 0 1-1.06 0l-2.25-2.25a.75.75 0 0 1 0-1.06ZM10.78 5.78a.75.75 0 0 1-1.06 0L8 4.06 6.28 5.78a.75.75 0 0 1-1.06-1.06l2.25-2.25a.75.75 0 0 1 1.06 0l2.25 2.25a.75.75 0 0 1 0 1.06Z"
								clip-rule="evenodd" />
						</svg>
					</span>
				</ListboxButton>
			</span>

			<transition leave-active-class="transition duration-100 ease-in" leave-from-class="opacity-100"
				leave-to-class="opacity-0" v-show="isOpen">
				<div class="absolute z-10 w-full mt-1 bg-white rounded-md shadow-lg">
					<ListboxOptions
						class="py-1 pl-px space-y-px overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5"
						static="static">
						<ListboxOption v-for="option in options" :key="option.id" :value="option"
							v-slot="{ selected: isSelected, active: isActive }" @click="onClick">
							<div :class="computedListboxOptionClasses(isSelected, isActive)">
								<span class="block text-left capitalize truncate"
									:class="{ 'font-semibold': isSelected, 'font-normal': !isSelected }">
									{{ option.name }}
								</span>
								<span v-if="isSelected" class="absolute inset-y-0 right-0 flex items-center pr-4"
									:class="{ 'text-white': isActive, 'text-gray-900': !isActive }">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4"
										aria-hidden="true">
										<path fill-rule="evenodd"
											d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z"
											clip-rule="evenodd" />
									</svg>
								</span>
							</div>
						</ListboxOption>
					</ListboxOptions>
				</div>
			</transition>
		</div>
	</Listbox>

	<p v-show="errorMessage" class="mt-2 text-sm text-red-600">
		{{ errorMessage }}
	</p>
</template>



