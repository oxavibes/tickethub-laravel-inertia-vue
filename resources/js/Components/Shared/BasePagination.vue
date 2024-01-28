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
	}
});

const computedClasses = computed(() => {
	return (link) => {
		return cva('flex min-w-max text-gray-500 leading-tight items-center justify-center px-3 h-8 border border-gray-300 hover:bg-gray-100 hover:text-gray-700', {
			variants: {
				intent: {
					next: 'rounded-e-lg bg-white',
					previous: 'ms-0 rounded-s-lg bg-white',
					current: 'text-black bg-gray-50 font-medium pointer-events-none',
				},
				disabled: {
					true: 'cursor-not-allowed opacity-75 hover:bg-white',
					false: 'cursor-pointer'
				},
			},
			compoundVariants: [
				{
					intent: ['previous', 'next'],
					current: false,
					class: 'bg-white'
				}
			],
			defaultVariants: {},
		})({
			intent: computedLinkClass.value(link),
			disabled: !link.url
		})
	}
});
</script>

<template>
	<nav class="flex items-center flex-column gap-3 flex-wrap md:flex-row justify-between pt-8"
		aria-label="Table navigation">
		<span class="text-sm font-normal text-gray-500 block w-full md:w-auto">
			Showing
			<span class="font-semibold text-gray-900">{{ data.from }}-{{ data.to }}</span> of
			<span class="font-semibold text-gray-900">{{ data.total }}</span>
		</span>

		<ul v-show="data.last_page > 1" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
			<li v-for="link in data.links" :key="link.label">
				<Component :is="computedComponent(link)" v-html="link.label" :href="link.url" :disabled="!link.url"
					:class="computedClasses(link)" :aria-current="link.active ? 'page' : undefined" />
			</li>
		</ul>
	</nav>
</template>

<style scoped>
</style>
