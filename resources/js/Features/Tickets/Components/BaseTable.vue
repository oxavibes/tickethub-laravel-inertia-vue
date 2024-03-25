<script setup>
import { ref, computed } from "vue";
import { router, usePage } from '@inertiajs/vue3'
import { watchDebounced } from '@vueuse/core'

import usePermission from '@/Composables/usePermission';

import BaseTag from "@/Components/Shared/BaseTag.vue";
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

const emit = defineEmits(['onCreate', 'onEdit', 'onDelete']);

const permissions = computed(() => usePage().props.auth.permissions);
const { hasPermission } = usePermission({ permissions: permissions.value, });

const canCreateTicket = hasPermission.value('create-tickets');
const canEditTicket = hasPermission.value('edit-tickets');
const canDeleteTicket = hasPermission.value('delete-tickets');

const search = ref(props.filters?.search);

watchDebounced(search, (value) => {
	router.get(route(props.route), { search: value }, {
		replace: true,
		preserveState: true,
	});
}, { debounce: 300 });
</script>

<template>
	<div class="relative px-6 pt-4 pb-6 overflow-x-auto bg-white shadow-sm sm:rounded-lg">
		<div class="flex flex-wrap items-baseline justify-between gap-4 pb-4 bg-white">
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

			<BaseButton :is-disabled="!canCreateTicket" :aria-disabled="!canCreateTicket" @click="$emit('onCreate')">
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
						<td v-if="header.key.includes('title')" class="px-6 py-4 text-gray-900 min-w-[150px] text-balance">
							{{ record[header.key] }}
						</td>

						<td v-else-if="header.key.includes('status')" class="px-6">
							<div class="flex items-center">
								<span v-if="record[header.key].includes('open')"
									class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></span>
								<span v-else class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></span>
								{{ record[header.key] }}
							</div>
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

						<td v-else-if="header.key.includes('actions')" class="px-6 py-4">
							<div class="flex flex-wrap gap-4 ">
								<a :disabled="!canEditTicket" :aria-disabled="!canEditTicket"
									:class="{ 'cursor-not-allowed pointer-events-none opacity-50': !canEditTicket }" href="#"
									type="button" @click="$emit('onEdit', record)" class="font-medium text-gray-900 hover:underline">Edit
								</a>

								<a :disabled="!canDeleteTicket" :aria-disabled="!canDeleteTicket"
									:class="{ 'cursor-not-allowed pointer-events-none opacity-50': !canDeleteTicket }" href="#"
									type="button" class="font-medium text-red-600 hover:underline"
									@click="$emit('onDelete', record)">Delete
								</a>
							</div>
						</td>

						<td v-else-if="Array.isArray(record[header.key])" class="px-6 py-4 text-gray-900">
							<div class="flex flex-wrap gap-3">
								<BaseTag v-for="{ title } in record[header.key]" :key="key">
									{{ title }}
								</BaseTag>
							</div>

						</td>

						<td v-else-if="header.key.includes('agent')" class="px-6 py-4 text-center text-gray-900">
							{{ record[header.key]?.name ?? 'Unassigned' }}
						</td>

						<td v-else class="max-w-[180px] px-6 py-4 text-gray-900 truncate">
							{{ record[header.key] }}
						</td>
					</template>
				</tr>
			</tbody>
		</table>

		<BasePagination :data="data" />
	</div>
</template>

<style scoped></style>
