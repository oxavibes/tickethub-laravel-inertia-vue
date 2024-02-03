<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia'

import { useModalStore } from '@/Stores/modals';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const form = useForm({
	password: '',
});

const modalStore = useModalStore();
const { accountModalOpen } = storeToRefs(modalStore)

const deleteUser = () => {
	form.delete(route('profile.destroy'), {
		preserveScroll: true,
		onSuccess: () => {
			accountModalOpen.value = false

			form.reset();
		},
	});
};

const input = ref(null);
watch(accountModalOpen, (isOpen) => {
	if (isOpen) {
		setTimeout(() => {
			input.value.focus()
		}, 0)
	}
});
</script>

<template>
	<BaseModal v-model:is-open="accountModalOpen" @on-close="accountModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-lg font-medium text-gray-900">
				Delete Account
			</h3>
		</template>

		<!-- Modal body -->
		<div>
			<p class="text-sm text-gray-600">
				Once your account is deleted, all of its resources and data will be permanently deleted. Please
				enter your password to confirm you would like to permanently delete your account.
			</p>

			<div class="mt-6">
				<BaseInput ref="input" label="Password" id="delete-account-password" type="password" v-model="form.password"
					@keyup.enter="deleteUser" :error-message="form.errors.password" />
			</div>
		</div>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="accountModalOpen = false"> Cancel </BaseButton>

			<BaseButton variant="danger" class="ms-3" :is-loading="form.processing" @click="deleteUser">
				Delete
			</BaseButton>
		</template>
	</BaseModal>
</template>


<style scoped>
</style>
