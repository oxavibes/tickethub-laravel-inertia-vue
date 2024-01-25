<script setup>
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import { watchDebounced } from '@vueuse/core'

import BaseButton from "@/Components/Buttons/BaseButton.vue";
import BasePagination from '@/Components/Shared/BasePagination.vue';

const props = defineProps({
	tableId: {
		type: [String, Number],
		required: true,
	},
	headers: {
		type: [Object],
		required: true,
		default: () => []
	},
	data: {
		type: [Object],
		required: true,
		default: () => { }
	},
	filters: {
		type: [Object],
	},
	placeholder: {
		type: [String],
	},
	route: {
		type: [String],
		required: true
	}
})

const search = ref(props.filters?.search);

const emit = defineEmits(['onCreate', 'onEdit', 'onDelete']);

watchDebounced(search, (value) => {
	router.get(route(props.route), { search: value }, {
		replace: true,
		preserveState: true,
	});
}, { debounce: 300 });
</script>

<template>
	<div class="bg-white relative overflow-x-auto shadow-sm sm:rounded-lg px-6 pt-4 pb-6">
		<div class="pb-4 bg-white dark:bg-gray-900 flex flex-wrap gap-4 justify-between items-baseline">
			<label :for="`${tableId}-table-search`" class="sr-only">Search</label>

			<div class="relative mt-1">
				<div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
					<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
						viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
					</svg>
				</div>

				<input type="text" :id="`${tableId}-table-search`" v-model="search"
					class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-black focus:border-black"
					:placeholder="placeholder">
			</div>

			<BaseButton @click="$emit('onCreate')" class="h-[38px]">
				<slot name="button" />
			</BaseButton>
		</div>

		<table class="w-full text-sm text-left rtl:text-right text-gray-500">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50">
				<tr>
					<th v-for="{ label, key } in headers" :key="key" scope="col" class="px-6 py-3">
						{{ label }}
					</th>
				</tr>
			</thead>

			<tbody>
				<tr v-show="!data?.data?.length" class="bg-white border-b hover:bg-gray-50">
					<td :colspan="headers.length" class="px-6 py-4 text-gray-900 text-center">
						No records found
					</td>
				</tr>

				<tr v-for="record in data?.data" :key="record" class="bg-white border-b hover:bg-gray-50">
					<template v-for="header in headers" :key="header.key">
						<td v-if="header.key.includes('status')" class="text-center">
							<span v-if="record[header.key].includes('open')"
								class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full">
								{{ record[header.key] }}
							</span>
							<span v-else class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full">
								{{ record[header.key] }}
							</span>
						</td>

						<td v-else-if="header.key.includes('priority')" class="text-center">
							<span v-if="record[header.key].includes('low')"
								class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full">
								{{ record[header.key] }}
							</span>

							<span v-else-if="record[header.key].includes('medium')"
								class="bg-yellow text-black text-sm font-medium me-2 px-2.5 py-0.5 rounded-full border border-yellow">{{
									record[header.key]
								}}</span>

							<span v-else class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-full">
								{{ record[header.key] }}
							</span>
						</td>

						<td v-else-if="header.key.includes('actions')" class="px-6 py-4 flex flex-wrap gap-4">
							<a href="#" type="button" @click="$emit('onEdit', record)"
								class="font-medium text-gray-900 hover:underline">Edit
							</a>

							<a href="#" type="button" class="font-medium text-red-600 hover:underline"
								@click="$emit('onDelete', record)">Delete </a>
						</td>

						<td v-else-if="Array.isArray(record[header.key])" class="px-6 py-4 text-gray-900">
							<span v-for="{ title } in record[header.key]" :key="key"
								class="inline-flex gap-2 bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded border-gray-500">
								{{ title }}
							</span>
						</td>

						<td v-else-if="header.key.includes('assigned_to')" class="px-6 py-4 text-gray-900">
							{{ record[header.key] ?? 'Unassigned' }}
						</td>

						<td v-else class="px-6 py-4 text-gray-900">
							{{ record[header.key] }}
						</td>
					</template>
				</tr>
			</tbody>
		</table>

		<BasePagination v-show="data?.data?.length" :data="data" />
	</div>
</template>

<style scoped>
</style>
