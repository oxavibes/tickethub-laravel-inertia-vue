<script setup>
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import { watchDebounced } from '@vueuse/core'

import BaseButton from '@/Components/Shared/BaseButton.vue';
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
		preserveScroll: true
	});
}, { debounce: 300 });
</script>

<template>
	<div class="relative px-6 pt-4 pb-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
		<div class="flex flex-wrap items-center justify-between gap-4 pb-4 bg-white">
			<label :for="`${tableId}-table-search`" class="sr-only">Search</label>

			<div class="relative mt-1">
				<div class="absolute inset-y-0 flex items-center pointer-events-none rtl:inset-r-0 start-0 ps-3">
					<svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
						viewBox="0 0 20 20">
						<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
					</svg>
				</div>

				<input type="text" :id="`${tableId}-table-search`" v-model="search"
					class="block pt-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-black focus:border-black"
					:placeholder="placeholder">
			</div>

			<BaseButton @click="$emit('onCreate')">
				<template #icon>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
						<path fill-rule="evenodd"
							d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm.75-10.25v2.5h2.5a.75.75 0 0 1 0 1.5h-2.5v2.5a.75.75 0 0 1-1.5 0v-2.5h-2.5a.75.75 0 0 1 0-1.5h2.5v-2.5a.75.75 0 0 1 1.5 0Z"
							clip-rule="evenodd" />
					</svg>
				</template>

				<slot name="button" />
			</BaseButton>
		</div>

		<table class="w-full text-sm text-left text-gray-500">
			<thead class="text-xs text-gray-700 uppercase bg-gray-50">
				<tr>
					<th v-for="{ label, key } in headers" :key="key" scope="col" class="px-6 py-3 text-nowrap">
						{{ label }}
					</th>
				</tr>
			</thead>

			<tbody>
				<tr v-show="!data?.data?.length" class="bg-white border-b">
					<td :colspan="headers.length" class="px-6 py-4 text-center text-gray-900">
						No records found
					</td>
				</tr>

				<tr v-for="record in data?.data" :key="record" class="border-b even:bg-white odd:bg-gray-50">
					<template v-for="header in headers" :key="header.key">
						<td v-if="!header.key.includes('actions') && !header.key.includes('visible')"
							class="px-6 py-4 text-gray-900">
							{{ record[header.key] }}
						</td>

						<td v-if="header.key.includes('visible')" class="px-6 py-4 text-gray-900">
							<svg v-if="record[header.key]" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
								viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
								stroke-linejoin="round" class="lucide lucide-circle-check">
								<circle cx="12" cy="12" r="10" />
								<path d="m9 12 2 2 4-4" />
							</svg>

							<svg v-else xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
								stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
								class="text-red-600 lucide lucide-circle-x">
								<circle cx="12" cy="12" r="10" />
								<path d="m15 9-6 6" />
								<path d="m9 9 6 6" />
							</svg>
						</td>
					</template>

					<!-- Actions -->
					<td class="flex flex-wrap gap-4 px-6 py-4">
						<a href="#" type="button" @click="$emit('onEdit', record)"
							class="font-medium text-gray-900 hover:underline">Edit
						</a>

						<a href="#" type="button" class="font-medium text-red-600 hover:underline"
							@click="$emit('onDelete', record)">Delete </a>
					</td>
				</tr>
			</tbody>
		</table>

		<BasePagination :data="data" />
	</div>
</template>

<style scoped></style>
