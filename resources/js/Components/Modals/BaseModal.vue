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
		<Transition enter-active-class="duration-300 ease-out" enter-from-class="opacity-0"
			enter-to-class="translate-y-0 opacity-100 sm:scale-100" leave-active-class=""
			leave-from-class="translate-y-0 opacity-100 sm:scale-100" leave-to-class="opacity-0">
			<div v-show="isOpen" tabindex="-1" aria-hidden="true" role="dialog"
				class="fixed top-0 left-0 right-0 z-[51] w-full p-2 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<div ref="target"
					class="relative w-full max-w-xl max-h-[600px] overflow-y-auto bg-white rounded inset-1/2 -translate-x-1/2 -translate-y-1/2">
					<div class="flex items-start justify-between p-4 border-b">
						<slot name="header">
							<h3 class="text-lg font-medium text-gray-900">
								Heading
							</h3>
						</slot>

						<button type="button" @click="$emit('onClose')"
							class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto">
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

					<div class="flex items-center justify-end p-6 space-x-3 border-t border-gray-200 rtl:space-x-reverse">
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
