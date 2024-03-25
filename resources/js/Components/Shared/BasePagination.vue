<script setup>
import { computed } from "vue";
import { cva } from "class-variance-authority";

defineProps({
	data: {
		type: [Object],
		required: true,
		default: () => { }
	}
})

const computedComponent = computed(() => {
	return (link) => {
		if (link.url) {
			return 'Link'
		} else {
			return 'span'
		}
	}
});

const computedLinkClass = computed(() => {
	return (link) => {
		if (link.label.includes('Previous')) {
			return 'previous'
		} else if (link.label.includes('Next')) {
			return 'next'
		} else if (link.active) {
			return 'current'
		}

		return 'default';
	}
});

const computedClasses = computed(() => {
	return (link) => {
		return cva('text-sm items-center justify-center border border-gray-300 shadow-sm outline-none', {
			variants: {
				variant: {
					next: 'px-2 py-2 text-gray-400 font-normal rounded-e-lg bg-white',
					previous: 'px-2 py-2 text-gray-400 font-normal ms-0 rounded-s-lg bg-white',
					current: 'px-4 py-2 text-gray-900 font-semibold bg-gray-50 pointer-events-none',
					default: 'px-4 py-2 text-gray-500 font-semibold'
				},
				disabled: {
					true: 'cursor-not-allowed opacity-75 hover:bg-white',
					false: 'cursor-pointer hover:bg-gray-50 hover:text-gray-700'
				},
			},
			compoundVariants: [
				{
					variant: ['previous', 'next'],
					current: false,
					class: 'bg-white'
				}
			],
			defaultVariants: {},
		})({
			variant: computedLinkClass.value(link),
			disabled: !link.url
		})
	}
});
</script>

<template>
	<nav v-if="data?.data?.length" class="flex flex-wrap items-center justify-between gap-3 pt-8 flex-column md:flex-row"
		aria-label="Table navigation">
		<span class="block w-full text-sm font-normal text-gray-500 md:w-auto">
			Showing
			<span class="font-semibold text-gray-900">{{ data.from }}-{{ data.to }}</span> of
			<span class="font-semibold text-gray-900">{{ data.total }}</span>
		</span>

		<ul v-show="data.last_page > 1" class="inline-flex -space-x-px text-sm rtl:space-x-reverse">
			<li v-for="link in data.links" :key="link.label">
				<Component :is="computedComponent(link)" v-html="link.label" :href="link.url" :disabled="!link.url"
					:class="computedClasses(link)" :aria-current="link.active ? 'page' : undefined" />
			</li>
		</ul>
	</nav>
</template>

<style scoped></style>
