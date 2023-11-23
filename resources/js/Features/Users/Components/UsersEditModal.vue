<script setup>
import BaseModal from '@/Components/Shared/BaseModal.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
</script>

<template>
	<BaseModal id="editUserModal">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
				Edit user
			</h3>
		</template>

		<!-- Modal body -->
		<div class="grid grid-cols-6 gap-6">
			<div class="col-span-6 sm:col-span-3">
				<label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
					Name</label>
				<input type="text" name="first-name" id="first-name"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="Bonnie" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="last-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
					Name</label>
				<input type="text" name="last-name" id="last-name"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="Green" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
				<input type="email" name="email" id="email"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="example@company.com" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="phone-number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone
					Number</label>
				<input type="number" name="phone-number" id="phone-number"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="e.g. +(12)3456 789" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="department" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
				<input type="text" name="department" id="department"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="Development" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="company" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Company</label>
				<input type="number" name="company" id="company"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="123456" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
					Password</label>
				<input type="password" name="current-password" id="current-password"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="••••••••" required="">
			</div>
			<div class="col-span-6 sm:col-span-3">
				<label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
					Password</label>
				<input type="password" name="new-password" id="new-password"
					class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					placeholder="••••••••" required="">
			</div>
		</div>

		<!-- Modal footer -->
		<template #footer>
			<PrimaryButton type="submit">
				Save all
			</PrimaryButton>
		</template>
	</BaseModal>
</template>



<style scoped>
</style>
