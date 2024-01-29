<script setup>
import { DeleteUserForm, UpdatePasswordForm, UpdateProfileInformationForm } from "@/Features/Profile"

defineProps({
	mustVerifyEmail: {
		type: Boolean,
	},
	status: {
		type: String,
	},
});
</script>

<template>
	<Head title="Profile" />

	<AuthenticatedLayout>
		<template #header>
			<h2 class="p-6 text-xl font-semibold leading-tight text-gray-800">Profile</h2>
		</template>

		<template #default>
			<div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
				<UpdateProfileInformationForm :status="status" :must-verify-email="mustVerifyEmail" class="max-w-xl" />
			</div>

			<div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
				<UpdatePasswordForm class="max-w-xl" />
			</div>

			<div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
				<DeleteUserForm class="max-w-xl" />
			</div>
		</template>
	</AuthenticatedLayout>
</template>
