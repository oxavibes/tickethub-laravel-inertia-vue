<script setup>
import { useForm } from '@inertiajs/vue3';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue';
import BaseCheckbox from '@/Components/Form/BaseCheckbox.vue';

defineProps({
	canResetPassword: {
		type: Boolean,
	},
	status: {
		type: String,
	},
});

const form = useForm({
	email: '',
	password: '',
	remember: false,
});

const onSubmit = () => {
	form.post(route('login'), {
		onSuccess: () => {
			const toastStore = useToastStore()

			toastStore.add({
				message: `Welcome back 👋`,
			})

			form.reset();
		},
	});
};
</script>

<template>
	<GuestLayout>

		<Head title="Log in" />

		<div v-if="status" class="mb-4 text-sm font-medium text-green-600">
			{{ status }}
		</div>

		<form @submit.prevent="onSubmit">
			<h3 class="mb-4 text-xl font-bold text-gray-700">
				Log in to your account
			</h3>

			<div>
				<BaseInput autofocus label="Email" id="login-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" />
			</div>

			<div class="mt-4">
				<BaseInput label="Password" id="login-password" type="password" v-model="form.password"
					:error-message="form.errors.password" @focus="form.clearErrors('password')" />
			</div>

			<div class="flex justify-between gap-2 mt-4">
				<label class="flex items-center">
					<BaseCheckbox name="remember" v-model:checked="form.remember" />
					<span class="text-sm text-gray-600 ms-2">Remember me</span>
				</label>

				<Link v-if="canResetPassword" :href="route('password.request')" class="inertia-link">
				Forgot your password?
				</Link>
			</div>

			<div class="flex flex-col gap-4 mt-4 sm:flex-row sm:items-center sm:justify-between">
				<Link :href="route('register')" class="inertia-link">
				<span class="!text-gray-600">Don't have an account?</span> Sign up
				</Link>

				<BaseButton :is-loading="form.processing">
					Log in
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
