<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia';

import { useModalStore } from '@/Stores/modals';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseRadio from '@/Components/Form/BaseRadio.vue';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const props = defineProps({
	user: {
		type: [Object],
		required: true
	}
})

let form = useForm({
	...props.user,
	role: props?.user?.roles,
	password: '',
	password_confirmation: '',
});

watch(() => props.user, (newVal) => {
	form.defaults({ ...newVal, role: props?.user?.roles }).reset();
});

const roleOptions = [
	{ id: 'edit-user-role-admin', value: 'admin', label: 'Admin' },
	{ id: 'edit-user-role-agent', value: 'agent', label: 'Agent' },
	{ id: 'edit-user-role-user', value: 'user', label: 'User' },
];

const modalStore = useModalStore();
const { editUserModalOpen } = storeToRefs(modalStore)

function onSubmit() {
	const uri = route('users.update', { user: props.user })

	form.patch(uri, {
		preserveScroll: true,
		onSuccess: () => {
			editUserModalOpen.value = false

			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'User updated successfully',
			})

			form.reset()
		},
	})
}

const input = ref(null);

watch(editUserModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="editUserModalOpen" @on-close="editUserModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Edit user
			</h3>
		</template>

		<!-- Modal body -->
		<form id="edit-user-form" class="grid gap-4" novalidate @submit.prevent="onSubmit">
			<BaseInput ref="input" label="Name" id="edit-user-name" type="text" placeholder="John Doe" v-model="form.name"
				:error-message="form.errors.name" @focus="form.clearErrors('name')" />

			<BaseInput label="Email" id="edit-user-email" placeholder="youremail@domain.com" type="email" v-model="form.email"
				:error-message="form.errors.email" @focus="form.clearErrors('email')" />

			<!-- <BaseInput label="Current password" id="edit-user-current-password" placeholder="••••••••" type="password"
				v-model="form.current_password" autocomplete="new-password" :error-message="form.errors.current_password"
				@focus="form.clearErrors('current_password')" /> -->

			<BaseInput label="New password" id="edit-user-password" placeholder="••••••••" type="password"
				v-model="form.password" autocomplete="new-password" :error-message="form.errors.password"
				@focus="form.clearErrors('password')" />

			<BaseInput label="Confirm password" id="edit-user-confirm-password" placeholder="••••••••" type="password"
				v-model="form.password_confirmation" autocomplete="new-password"
				:error-message="form.errors.password_confirmation" @focus="form.clearErrors('confirm-password')" />

			<div>
				<label class="block mb-2 text-sm font-medium text-gray-900">
					Role
				</label>

				<div class="flex flex-wrap gap-4">
					<div v-for="option in roleOptions" class="flex-1">
						<BaseRadio v-model="form.role" :option="option" />
					</div>
				</div>

				<p v-show="form.errors.role" class="mt-2 text-sm text-red-600">
					{{ form.errors.role }}
				</p>
			</div>
		</form>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="editUserModalOpen = false">
				Cancel
			</BaseButton>

			<BaseButton form="edit-user-form" type="submit" :isLoading="form.processing">
				Save
			</BaseButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
