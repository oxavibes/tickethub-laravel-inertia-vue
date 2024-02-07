<script setup>
import { onUnmounted } from 'vue'
import { router, usePage } from '@inertiajs/vue3'

import { useToastStore } from '@/Stores/toast'
import ToastListItem from '@/Components/Shared/ToastListItem.vue'

const page = usePage()
const toastStore = useToastStore()

const removeFinishEventListener = router.on('finish', () => {
	if (page.props.toast) {
		toastStore.add({
			message: page.props.toast,
		})
	}
})

onUnmounted(() => removeFinishEventListener())

function remove(index) {
	toastStore.remove(index)
}
</script>

<template>
	<TransitionGroup tag="div" enter-from-class="translate-x-full opacity-0" enter-active-class="duration-300"
		leave-active-class="duration-300" leave-to-class="translate-x-full opacity-0"
		class="fixed top-2 right-2 z-[100] w-full max-w-xs space-y-4">
		<ToastListItem v-for="(item, index) in toastStore.items" :key="item.key" :message="item.message" :type="item.type"
			@remove="remove(index)" />
	</TransitionGroup>
</template>
