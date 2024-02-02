<script setup>
import { useForm } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const form = useForm({
	password: '',
});

const submit = () => {
	form.post(route('password.confirm'), {
		onFinish: () => form.reset(),
	});
};
</script>

<template>
	<GuestLayout>

		<Head title="Confirm Password" />

		<h3 class="mb-4 text-xl font-bold text-gray-700">
			Confirm your password
		</h3>

		<div class="mb-4 text-sm text-gray-600">
			This is a secure area of the application. Please confirm your password before continuing.
		</div>

		<form @submit.prevent="submit">
			<div>
				<BaseInput autofocus label="Password" id="confirm-password-password" autocomplete="current-password"
					type="password" v-model="form.password" :error-message="form.errors.password"
					@focus="form.clearErrors('password')" />
			</div>

			<div class="flex justify-end mt-4">
				<BaseButton class="ms-4" :is-loading="form.processing">
					Confirm
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
