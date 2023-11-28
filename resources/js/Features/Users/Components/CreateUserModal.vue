<script setup>
import BaseModal from '@/Components/Shared/BaseModal.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
</script>

<template>
	<BaseModal id="createUserModal">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				New User
			</h3>
		</template>

		<!-- Modal body -->
		<div class="grid grid-cols-6 gap-6">
			<div class="col-span-6 sm:col-span-3">
				<label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">
					Name
				</label>
				<input type="text" name="first-name" id="first-name"
					class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
					placeholder="Bonnie">
			</div>

			<div class="col-span-6 sm:col-span-3">
				<label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">
					Email
				</label>
				<input type="text" name="first-name" id="first-name"
					class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
					placeholder="Bonnie">
			</div>

			<div class="col-span-6 sm:col-span-3">
				<label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
				<select id="category"
					class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
					<option selected="">Select category</option>
					<option value="TV">TV/Monitors</option>
					<option value="PC">PC</option>
					<option value="GA">Gaming/Console</option>
					<option value="PH">Phones</option>
				</select>
			</div>

		</div>

		<!-- Modal footer -->
		<template #footer>
			<PrimaryButton type="submit">
				Create
			</PrimaryButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
