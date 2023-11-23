<script setup>
import { onMounted } from 'vue'
import { initModals } from "flowbite";

const props = defineProps(['id'])

onMounted(() => {
	initModals()
});
</script>

<template>
	<Teleport to="body">
		<Transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0"
			enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class=""
			leave-from-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0">
			<div :id="id" tabindex="-1" aria-hidden="true"
				class="hidden fixed top-0 left-0 right-0 z-[51] w-full p-2 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
				<form action="#" class="relative w-full max-w-xl max-h-full bg-white rounded">
					<div class="flex items-start justify-between p-4 border-b">
						<slot name="header">
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
								Heading
							</h3>
						</slot>

						<button type="button"
							class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
							data-modal-hide="editUserModal">
							<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
							</svg>
							<span class="sr-only">Close modal</span>
						</button>
					</div>

					<div class="p-6 space-y-6">
						<slot />
					</div>

					<div class="flex items-center p-6 space-x-3 rtl:space-x-reverse border-t border-gray-200">
						<slot name="footer" />
					</div>
				</form>
			</div>
		</Transition>
	</Teleport>
</template>
