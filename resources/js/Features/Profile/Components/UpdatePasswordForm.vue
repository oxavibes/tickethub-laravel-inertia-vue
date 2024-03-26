<script setup>
import { useForm } from '@inertiajs/vue3';
import { useToastStore } from '@/Stores/toast';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

const form = useForm({
	current_password: '',
	password: '',
	password_confirmation: '',
});

const onSubmit = () => {
	form.put(route('password.update'), {
		preserveScroll: true,
		onSuccess: () => {
			const toastStore = useToastStore()

			toastStore.add({
				type: 'success',
				message: 'Password updated successfully',
			})

			form.reset()
		},
		onError: () => { }
	});
};
</script>

<template>
	<section>
		<header>
			<h2 class="text-lg font-medium text-gray-900">Update Password</h2>

			<p class="mt-1 text-sm text-gray-600">
				Ensure your account is using a long, random password to stay secure.
			</p>
		</header>

		<hr class="my-6">

		<form @submit.prevent="onSubmit" class="mt-6 space-y-6">
			<div>
				<BaseInput label="Current Password" id="update-current-password" type="password" v-model="form.current_password"
					:error-message="form.errors.current_password" @focus="form.clearErrors('current_password')" />
			</div>

			<div>
				<BaseInput label="New Password" id="update-new-password" type="password" autocomplete="new-password"
					v-model="form.password" :error-message="form.errors.password" @focus="form.clearErrors('password')" />
			</div>

			<div>
				<BaseInput label="Confirm Password" id="update-password-confirmation" type="password"
					autocomplete="new-password" v-model="form.password_confirmation"
					:error-message="form.errors.password_confirmation" @focus="form.clearErrors('password_confirmation')" />
			</div>

			<div class="flex items-center gap-4">
				<BaseButton :is-loading="form.processing">Save</BaseButton>

				<Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
					leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
					<p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
				</Transition>
			</div>
		</form>
	</section>
</template>
