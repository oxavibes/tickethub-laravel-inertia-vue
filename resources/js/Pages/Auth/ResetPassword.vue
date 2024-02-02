<script setup>
import { useForm } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const props = defineProps({
	email: {
		type: String,
		required: true,
	},
	token: {
		type: String,
		required: true,
	},
});

const form = useForm({
	token: props.token,
	email: props.email,
	password: '',
	password_confirmation: '',
});

const submit = () => {
	form.post(route('password.store'), {
		onSuccess: () => form.reset(),
	});
};
</script>

<template>
	<GuestLayout>

		<Head title="Reset Password" />

		<h3 class="mb-4 text-xl font-bold text-gray-700">
			Reset your password
		</h3>

		<form @submit.prevent="submit">
			<div>
				<BaseInput label="Email" autofocus id="reset-password-email" type="email" v-model="form.email"
					autocomplete="username" :error-message="form.errors.email" @focus="form.clearErrors('email')" />
			</div>

			<div class="mt-4">
				<BaseInput label="Password" id="reset-password-password" autocomplete="new-password" type="password"
					v-model="form.password" :error-message="form.errors.password" @focus="form.clearErrors('password')" />
			</div>

			<div class="mt-4">
				<BaseInput label="Confirm Password" id="reset-password-password-confirmation" autocomplete="new-password"
					type="password" v-model="form.password_confirmation" :error-message="form.errors.password_confirmation"
					@focus="form.clearErrors('password_confirmation')" />
			</div>

			<div class="flex items-center justify-end mt-4">
				<BaseButton :is-loading="form.processing">
					Reset Password
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
