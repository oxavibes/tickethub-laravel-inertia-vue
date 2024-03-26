<script setup>
import { useForm, usePage } from '@inertiajs/vue3';

import BaseInput from '@/Components/Form/BaseInput.vue';
import BaseButton from '@/Components/Shared/BaseButton.vue'

defineProps({
	mustVerifyEmail: {
		type: Boolean,
	},
	status: {
		type: String,
	},
});

const user = usePage().props.auth.user;

const form = useForm({
	name: user.name,
	email: user.email,
});
</script>

<template>
	<section>
		<header>
			<h2 class="text-lg font-medium text-gray-900">Profile Information</h2>

			<p class="mt-1 text-sm text-gray-600">
				Update your account's profile information and email address.
			</p>
		</header>

		<hr class="my-6">

		<form @submit.prevent="form.patch(route('profile.update'))" class="space-y-6">
			<div>
				<BaseInput label="Name" id="update-profile-name" type="text" v-model="form.name"
					:error-message="form.errors.name" @focus="form.clearErrors('name')" autocomplete="name" />
			</div>

			<div>
				<BaseInput label="Email" id="update-profile-email" type="email" v-model="form.email"
					:error-message="form.errors.email" @focus="form.clearErrors('email')" autocomplete="username" />
			</div>

			<div v-if="mustVerifyEmail && user.email_verified_at === null">
				<p class="mt-2 text-sm text-gray-800">
					Your email address is unverified.
					<Link :href="route('verification.send')" method="post" as="button"
						class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
					Click here to re-send the verification email.
					</Link>
				</p>

				<div v-show="status === 'verification-link-sent'" class="mt-2 text-sm font-medium text-green-600">
					A new verification link has been sent to your email address.
				</div>
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
