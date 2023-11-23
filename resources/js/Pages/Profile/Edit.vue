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
			<h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
		</template>

		<template #default>
			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<UpdateProfileInformationForm :status="status" :must-verify-email="mustVerifyEmail" class="max-w-xl" />
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<UpdatePasswordForm class="max-w-xl" />
			</div>

			<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
				<DeleteUserForm class="max-w-xl" />
			</div>
		</template>
	</AuthenticatedLayout>
</template>
