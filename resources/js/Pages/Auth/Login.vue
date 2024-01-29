<script setup>
import { useForm } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Buttons/BaseButton.vue';

import Checkbox from '@/Components/Form/Checkbox.vue';

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
		onSuccess: () => form.reset(),
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
			<div>
				<BaseInput autofocus label="Email" id="login-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" />
			</div>

			<div class="mt-4">
				<BaseInput label="Password" id="login-password" type="password" v-model="form.password"
					:error-message="form.errors.password" @focus="form.clearErrors('password')" />
			</div>

			<div class="block mt-4">
				<label class="flex items-center">
					<Checkbox name="remember" v-model:checked="form.remember" />
					<span class="text-sm text-gray-600 ms-2">Remember me</span>
				</label>
			</div>

			<div class="flex flex-col gap-4 mt-4 sm:flex-row sm:items-center sm:justify-between">
				<Link v-if="canResetPassword" :href="route('password.request')"
					class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
				Forgot your password?
				</Link>

				<BaseButton :is-loading="form.processing">
					Log in
				</BaseButton>
			</div>
		</form>
	</GuestLayout>
</template>
