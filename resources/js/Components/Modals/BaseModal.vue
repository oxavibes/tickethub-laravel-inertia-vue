<script setup>
import { computed, ref } from 'vue'
import useHideScrollbar from '@/Composables/useHideScrollbar';

const props = defineProps({
	isOpen: {
		type: [Boolean],
		required: true,
		default: false
	}
})

const emit = defineEmits(['onClose', 'update:isOpen'])

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
			<div v-show="isOpen" tabindex="-1" aria-hidden="true" role="dialog"
				class="fixed top-0 left-0 right-0 z-[51] w-full p-2 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<div ref="target"
					class="relative w-full max-w-xl max-h-[560px] overflow-y-auto bg-white rounded inset-1/2 -translate-x-1/2 -translate-y-1/2">
					<div class="flex items-start justify-between p-4 border-b">
						<slot name="header">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
								Heading
							</h3>
						</slot>

						<button type="button" @click="$emit('onClose')"
							class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
							<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
							</svg>
							<span class="sr-only">Close modal</span>
						</button>
					</div>

					<div class="p-6 space-y-6 overflow-y-auto">
						<slot />
					</div>

					<div class="flex justify-end items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200">
						<slot name="footer" />
					</div>
				</div>
			</div>
		</Transition>

		<div v-show="isOpen" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50" />
	</Teleport>
</template>

<style scoped>
</style>
