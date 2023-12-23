<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

import { storeToRefs } from 'pinia'
import { useModalStore } from '@/Stores/modals';

import BaseModal from '@/Components/Modals/BaseModal.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

import TextInput from '@/Components/Form/TextInput.vue';
import InputError from '@/Components/Form/InputError.vue';
import InputLabel from '@/Components/Form/InputLabel.vue';

const form = useForm({
	password: '',
});

const modalStore = useModalStore();
const { accountModalOpen } = storeToRefs(modalStore)


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
	<BaseModal :is-open="accountModalOpen" @on-close="accountModalOpen = false">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
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
				<InputLabel for="password" value="Password" class="sr-only" />

				<TextInput id="password" ref="passwordInput" v-model="form.password" type="password" class="mt-1 block w-full"
					placeholder="Password" @keyup.enter="deleteUser" />

				<InputError :message="form.errors.password" class="mt-2" />
			</div>
		</div>

		<!-- Modal footer -->
		<template #footer>
			<BaseButton variant="secondary" @click="accountModalOpen = false"> Cancel </BaseButton>

			<BaseButton variant="danger" class="ms-3" :is-loading="form.processing" @click="deleteUser">
				Delete Account
			</BaseButton>
		</template>
	</BaseModal>
</template>


<style scoped>
</style>
