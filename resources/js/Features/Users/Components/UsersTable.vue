<script setup>
import { onMounted } from "vue";
import { initModals, initDropdowns } from "flowbite";

import UsersTablePagination from "./UsersTablePagination.vue";

onMounted(() => {
	initModals()
	initDropdowns()
});
</script>

<template>
	<div class="relative bg-white overflow-x-auto shadow-sm sm:rounded-lg px-6 pt-4 pb-6">
		<div class="flex justify-end py-4 bg-white ">
			<label for="table-search" class="sr-only">Search</label>
			<div class="relative">
				<div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
					<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
						viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
					</svg>
				</div>
				<input type="text" id="table-search-users"
					class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
					placeholder="Search for users">
			</div>
		</div>

		<table class="w-full text-sm text-left rtl:text-right text-gray-500">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50">
				<tr>
					<th scope="col" class="px-6 py-3">
						Name
					</th>
					<th scope="col" class="px-6 py-3">
						Email
					</th>
					<th scope="col" class="px-6 py-3">
						Role
					</th>
					<th scope="col" class="px-6 py-3">
						Action
					</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for="i in 10" class="bg-white border-b hover:bg-gray-50">
					<th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap">
						<div>
							<span class="text-base font-semibold">Neil Sims</span>
						</div>
					</th>
					<td class="px-6 py-4">
						<span class="font-normal text-gray-500">neil.sims@flowbite.com</span>
					</td>
					<td class="px-6 py-4">
						<span class="font-normal text-gray-500">Agent</span>
					</td>
					<td class="px-6 py-4 space-x-2">
						<!-- Modal toggle -->
						<a href="#" type="button" data-modal-target="editUserModal" data-modal-show="editUserModal"
							class="font-medium text-gray-900 hover:underline">Edit </a>

						<a href="#" type="button" data-modal-target="deleteUserModal" data-modal-show="deleteUserModal"
							class="font-medium text-red-600 hover:underline">Delete </a>
					</td>
				</tr>
			</tbody>
		</table>

		<UsersTablePagination />
	</div>
</template>

<style scoped>
</style>
