<script setup>
import { useForm } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

defineProps({
	status: {
		type: String,
	},
});

const form = useForm({
	email: '',
});

const submit = () => {
	form.post(route('password.email'));
};
</script>

<template>
	<GuestLayout>

		<Head title="Forgot Password" />

		<h3 class="mb-4 text-xl font-bold text-gray-700">
			Recover Password
		</h3>

		<div class="mb-4 text-sm text-gray-600">
			Forgot your password? No problem. Just let us know your email address and we will email you a password reset
			link that will allow you to choose a new one.
		</div>

		<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div>
				<BaseInput autofocus label="Email" id="forgot-password-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" />
			</div>

			<div class="flex flex-col gap-4 mt-4 sm:flex-row sm:items-center sm:justify-between">
				<Link :href="route('login')" class="inertia-link">
				Go back
				</Link>

				<BaseButton :is-loading="form.processing">
					Send Reset Link
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
