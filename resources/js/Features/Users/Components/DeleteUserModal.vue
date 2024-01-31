<script setup>
import { useForm } from '@inertiajs/vue3';
import { storeToRefs } from 'pinia'
import { useModalStore } from '@/Stores/modals';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

const props = defineProps({
	user: {
		type: [Object],
		required: true,
		default: () => ({
			name: '',
			email: '',
			role: '',
		})
	},
})

const form = useForm({});

const modalStore = useModalStore();
const { deleteUserModalOpen } = storeToRefs(modalStore);

function onDelete() {
	const uri = route('users.destroy', { user: props.user })

	form.delete(uri, {
		preserveScroll: true,
		onSuccess: () => {
			deleteUserModalOpen.value = false

			form.reset()
		},
	})
}
</script>

<template>
	<BaseModal v-model:is-open="deleteUserModalOpen" @on-close="deleteUserModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Delete user
			</h3>
		</template>

		<!-- Modal body -->
		<div>
			<p class="text-sm text-gray-500">
				This action cannot be undone. Do you want to proceed with the deletion?
			</p>

		</div>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="deleteUserModalOpen = false"> Cancel </BaseButton>

			<BaseButton @click="onDeleteUser" variant="danger" class="ms-3" :is-loading="form.processing">
				Delete
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
