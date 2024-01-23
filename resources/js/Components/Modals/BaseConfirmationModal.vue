<script setup>
import { computed, ref } from 'vue'
import useHideScrollbar from '@/Composables/useHideScrollbar';

import BaseButton from '@/Components/Buttons/BaseButton.vue';

const props = defineProps({
	isOpen: {
		type: [Boolean],
		required: true,
		default: false
	},
	isLoading: {
		type: [Boolean],
		default: false
	}
})

const emit = defineEmits(['onConfirm', 'onClose', 'update:isOpen'])

const target = ref()
const currentModalModel = computed({
	get: () => props.isOpen,
	set: (value) => {
		emit('update:isOpen', value)
	}
})

useHideScrollbar({ target, currentModalModel })
</script>

<template>
	<Teleport to="body">
		<Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0"
			enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class=""
			leave-from-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0">
			<div v-show="isOpen" tabindex="-1"
				class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[51] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<div ref="target" class="relative p-4 w-full max-w-md max-h-full inset-1/2 -translate-x-1/2 -translate-y-1/2">
					<form class="relative bg-white rounded-lg shadow dark:bg-gray-700">

						<button type="button" @click="$emit('onClose')"
							class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
							<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
							</svg>
							<span class="sr-only">Close modal</span>
						</button>

						<div class="p-4 md:p-5 text-center">
							<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
								xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
							</svg>

							<h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
								<slot name="title"></slot>
							</h3>

							<div class="flex justify-center items-center">
								<BaseButton variant="danger" @click="$emit('onConfirm')" :is-loading="isLoading">
									Yes, I'm sure
								</BaseButton>

								<BaseButton variant="tertiary" @click="$emit('onClose')">
									No, cancel
								</BaseButton>
							</div>
						</div>
					</form>
				</div>
			</div>
		</Transition>

		<div v-show="isOpen" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50" />
	</Teleport>
</template>

<style scoped>
</style>