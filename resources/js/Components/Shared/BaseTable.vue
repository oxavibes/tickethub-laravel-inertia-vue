<script setup>
import PrimaryButton from "@/Components/Buttons/PrimaryButton.vue";
import BasePagination from '@/Components/Shared/BasePagination.vue';

const props = defineProps({
	name: [String],
	targetModalId: [String],
})

const dataModalTargetNew = `create${props.targetModalId}Modal`;
const dataModalTargetEdit = `edit${props.targetModalId}Modal`;
const dataModalTargetDelete = `delete${props.targetModalId}Modal`;
</script>

<template>
	<div class="bg-white relative overflow-x-auto shadow-sm sm:rounded-lg px-6 pt-4 pb-6">
		<div class="pb-4 bg-white dark:bg-gray-900 flex flex-wrap gap-4 justify-between items-baseline">
			<label :for="`${name}-table-search`" class="sr-only">Search</label>
			<div class="relative mt-1">
				<div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
					<svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
						fill="none" viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
					</svg>
				</div>
				<input type="text" :id="`${name}-table-search`"
					class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
					:placeholder="`Search for ${name}`">
			</div>


			<PrimaryButton :data-modal-target="dataModalTargetNew" :data-modal-show="dataModalTargetNew" class="h-[38px]">
				<slot name="buttonText"></slot>
			</PrimaryButton>
		</div>

		<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th scope="col" class="px-6 py-3">
						Title
					</th>
					<th scope="col" class="px-6 py-3">
						Slug
					</th>
					<th scope="col" class="px-6 py-3">
						Visible
					</th>
					<th scope="col" class="px-6 py-3">
						Action
					</th>
				</tr>
			</thead>

			<tbody>
				<tr v-for=" i in 10" :key="i"
					class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

					<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
						Title
					</th>
					<td class="px-6 py-4">
						Slug
					</td>
					<td class="px-6 py-4">
						True
					</td>

					<td class="px-6 py-4 flex flex-wrap gap-4">
						<a href="#" type="button" :data-modal-target="dataModalTargetEdit" :data-modal-show="dataModalTargetEdit"
							class="font-medium text-gray-900 hover:underline">Edit </a>

						<a href="#" type="button" :data-modal-target="dataModalTargetDelete" :data-modal-show="dataModalTargetDelete"
							class="font-medium text-red-600 hover:underline">Delete </a>
					</td>
				</tr>
			</tbody>
		</table>

		<BasePagination />
	</div>
</template>

<style scoped>
</style>
