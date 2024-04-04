<script setup>
import { useToastStore } from '@/Stores/toast'
import ToastListItem from '@/Components/Shared/ToastListItem.vue'

const toastStore = useToastStore()

function remove(index) {
	toastStore.remove(index)
}
</script>

<template>
	<TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-300"
		leave-active-class="duration-300" leave-to-class="translate-x-full opacity-0"
		class="fixed bottom-4 right-4 z-[100] w-full max-w-xs space-y-4">
		<ToastListItem v-for="(item, index) in toastStore.items" :key="item.key" :message="item.message" :type="item.type"
			@remove="remove(index)" />
	</TransitionGroup>
</template>
