<script setup>
import { computed, ref } from 'vue'
import useHideScrollbar from '@/Composables/useHideScrollbar';

import BaseButton from '@/Components/Shared/BaseButton.vue'

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
		<Transition enter-active-class="duration-300 ease-out" enter-from-class="opacity-0"
			enter-to-class="translate-y-0 opacity-100 sm:scale-100" leave-active-class=""
			leave-from-class="translate-y-0 opacity-100 sm:scale-100" leave-to-class="opacity-0">
			<div v-show="isOpen" tabindex="-1"
				class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[51] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<div ref="target" class="relative w-full max-w-md max-h-full p-4 -translate-x-1/2 -translate-y-1/2 inset-1/2">
					<form class="relative bg-white rounded-lg shadow">

						<button type="button" @click="$emit('onClose')"
							class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
							<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
							</svg>
							<span class="sr-only">Close modal</span>
						</button>

						<div class="p-4 text-center md:p-5">
							<svg class="w-12 h-12 mx-auto mb-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
								fill="none" viewBox="0 0 20 20">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
							</svg>

							<h3 class="mb-5 text-lg font-normal text-gray-500">
								<slot name="title"></slot>
							</h3>

							<div class="flex items-center justify-center">
								<BaseButton variant="danger" @click="$emit('onConfirm')" :is-loading="isLoading">
									Yes, I'm sure
								</BaseButton>

								<BaseButton variant="secondary" @click="$emit('onClose')">
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
