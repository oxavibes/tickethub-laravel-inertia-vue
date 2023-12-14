<script setup>
import { computed } from "vue";
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
		} else {
			return 'normal'
		}
	}
});
</script>

<template>
	<nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-8" aria-label="Table navigation">
		<span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
			Showing
			<span class="font-semibold text-gray-900 dark:text-white">{{ data.from }}-{{ data.to }}</span> of
			<span class="font-semibold text-gray-900 dark:text-white">{{ data.total }}</span>
		</span>

		<ul v-show="data.last_page > 1" class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
			<li v-for="link in data.links" :key="link.label">
				<Component :is="computedComponent(link)" v-html="link.label" :href="link.url" class="base"
					:class="computedLinkClass(link)" :aria-current="link.active ? 'page' : undefined" />
			</li>
		</ul>
	</nav>
</template>

<style lang="postcss" scoped>
.base {
	@apply flex items-center justify-center px-3 h-8 border border-gray-300
}

.previous {
	@apply ms-0 leading-tight text-gray-500 bg-white rounded-s-lg hover:bg-gray-100 hover:text-gray-700
}

.normal {
	@apply leading-tight text-gray-500 bg-white hover:bg-gray-100 hover:text-gray-700
}

.current {
	@apply text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700
}

.next {
	@apply leading-tight text-gray-500 bg-white rounded-e-lg hover:bg-gray-100 hover:text-gray-700
}
</style>
