<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

import BaseModal from '@/Components/Shared/BaseModal.vue';

import TextInput from '@/Components/Form/TextInput.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';

import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import DangerButton from '@/Components/Buttons/DangerButton.vue';


const form = useForm({
	password: '',
});


const deleteUser = () => {
	form.delete(route('profile.destroy'), {
		preserveScroll: true,
		onSuccess: () => onSuccess(),
		onError: () => passwordInput.value.focus(),
		onFinish: () => form.reset(),
	});
};

const onSuccess = () => {
	form.reset();
};

const passwordInput = ref(null);

onMounted(() => {
	passwordInput.value.focus();
});
</script>

<template>
	<BaseModal id="deleteUserModal">
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
				Delete Account
			</h3>
		</template>

		<div>
			<p class="text-sm text-gray-600">
				Once your account is deleted, all of its resources and data will be permanently deleted. Please
				enter your password to confirm you would like to permanently delete your account.
			</p>

			<div class="mt-6">
				<InputLabel for="password" value="Password" class="sr-only" />

				<TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full"
					placeholder="Password" @keyup.enter="deleteUser" />

				<InputError :message="form.errors.password" class="mt-2" />
			</div>

		</div>

		<template #footer>
			<SecondaryButton data-modal-hide="deleteUserModal"> Cancel </SecondaryButton>

			<DangerButton class="ms-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
				@click="deleteUser">
				Delete Account
			</DangerButton>
		</template>
	</BaseModal>
</template>


<style lang="scss" scoped>
</style>
