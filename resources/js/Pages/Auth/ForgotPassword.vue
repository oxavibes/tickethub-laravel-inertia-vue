<script setup>
import { useForm } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

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

		<div class="mb-4 text-sm text-gray-600">
			Forgot your password? No problem. Just let us know your email address and we will email you a password reset
			link that will allow you to choose a new one.
		</div>

		<div v-if="status" class="mb-4 font-medium text-sm text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="submit">
			<div>
				<BaseInput autofocus label="Email" id="forgot-password-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" />
			</div>

			<div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
				<Link :href="route('login')"
					class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
				Go back
				</Link>

				<BaseButton class="align-self-center" :is-loading="form.processing">
					Send Reset Link
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
