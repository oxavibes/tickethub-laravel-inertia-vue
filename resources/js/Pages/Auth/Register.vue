<script setup>
import { useForm } from '@inertiajs/vue3';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const form = useForm({
	name: '',
	email: '',
	password: '',
	password_confirmation: '',
});

const submit = () => {
	form.post(route('register'), {
		onSuccess: () => {
			const toastStore = useToastStore()

			toastStore.add({
				message: `Welcome to TicketHub 🥳`,
			})

			form.reset()
		},
	});
};
</script>

<template>
	<GuestLayout>

		<Head title="Register" />

		<form @submit.prevent="submit">
			<h3 class="mb-4 text-xl font-bold text-gray-700">
				Tell us about yourself
			</h3>

			<div>
				<BaseInput autofocus label="Name" id="register-name" type="text" v-model="form.name" autocomplete="name"
					:error-message="form.errors.name" @focus="form.clearErrors('name')" />
			</div>

			<div class="mt-4">
				<BaseInput autocomplete="username" label="Email" id="register-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" />

			</div>

			<div class="mt-4">
				<BaseInput label="Password" id="register-password" autocomplete="new-password" type="password"
					v-model="form.password" :error-message="form.errors.password" @focus="form.clearErrors('password')" />
			</div>

			<div class="mt-4">
				<BaseInput label="Confirm Password" id="register-password-confirmation" autocomplete="new-password"
					type="password" v-model="form.password_confirmation" :error-message="form.errors.password_confirmation"
					@focus="form.clearErrors('password_confirmation')" />
			</div>

			<div class="flex flex-col gap-4 mt-4 sm:flex-row sm:items-center sm:justify-between">
				<Link :href="route('login')" class="inertia-link">
				Already registered?
				</Link>

				<BaseButton :is-loading="form.processing">
					Register
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
