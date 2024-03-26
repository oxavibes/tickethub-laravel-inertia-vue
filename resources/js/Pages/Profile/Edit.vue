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
			<div class="flex items-center justify-between p-6">
				<h2 class="text-xl font-semibold leading-tight text-gray-800">Profile</h2>

				<DeleteUserForm />
			</div>
		</template>

		<template #default>
			<div class="grid gap-6">
				<div class="p-6 bg-white rounded-lg shadow sm:p-8">
					<UpdateProfileInformationForm :status="status" :must-verify-email="mustVerifyEmail" class="max-w-xl" />
				</div>

				<div class="p-6 bg-white rounded-lg shadow sm:p-8">
					<UpdatePasswordForm class="max-w-xl" />
				</div>
			</div>
		</template>
	</AuthenticatedLayout>
</template>
