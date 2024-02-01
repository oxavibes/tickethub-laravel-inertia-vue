<script setup>
import { computed } from 'vue';
import { useForm } from '@inertiajs/vue3';

import BaseButton from '@/Components/Shared/BaseButton.vue'

const props = defineProps({
	status: {
		type: String,
	},
});

const form = useForm({});

const submit = () => {
	form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
	<GuestLayout>

		<Head title="Email Verification" />

		<div class="mb-4 text-sm text-gray-600">
			Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
			we just emailed to you? If you didn't receive the email, we will gladly send you another.
		</div>

		<div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent">
			A new verification link has been sent to the email address you provided during registration.
		</div>

		<form @submit.prevent="submit">
			<div class="flex items-center justify-between mt-4">
				<BaseButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
					Resend Verification Email
				</BaseButton>

				<Link :href="route('logout')" method="post" as="button" class="inertia-link">
				Log Out</Link>
			</div>
		</form>
	</GuestLayout>
</template>
