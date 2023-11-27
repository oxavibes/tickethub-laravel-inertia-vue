<script setup>
import BaseModal from '@/Components/Shared/BaseModal.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
</script>

<template>
	<BaseModal id="editLabelModal">
		<!-- Modal header -->
		<template #header>
			<h3 class="text-xl font-semibold text-gray-900">
				Edit label
			</h3>
		</template>

		<!-- Modal body -->
		<div class="grid gap-6">
			<div class="">
				<label for="first-name" class="block mb-2 text-sm font-medium text-gray-900">
					Name
				</label>
				<input type="text" name="first-name" id="first-name"
					class="shadow-sm border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
					placeholder="Bonnie">
			</div>

			<div class="">
				<label for="" class="block mb-2 text-sm font-medium text-gray-900">
					Is Visible?
				</label>

				<div class="flex flex-wrap gap-6">
					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
							<input id="is-visible-true" type="radio" value="" name="bordered-radio"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
							<label for="is-visible-true"
								class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">True</label>
						</div>
					</div>

					<div class="flex-1">
						<div class=" flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
							<input id="is-visible-false" type="radio" value="" name="bordered-radio"
								class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
							<label for="is-visible-false"
								class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">False</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal footer -->
		<template #footer>
			<PrimaryButton type="submit">
				Save
			</PrimaryButton>
		</template>
	</BaseModal>
</template>

<style scoped>
</style>
