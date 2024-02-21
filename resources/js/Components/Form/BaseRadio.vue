<script setup>
const model = defineModel({ type: [String, Number, Boolean], required: true })

const props = defineProps({
	option: {
		type: [Object],
		required: true,
	},
})
</script>

<template>
	<div class="flex-1">
		<div class="flex items-center">
			<label :for="option.id"
				class="w-full p-4 text-sm font-medium text-gray-900 border border-gray-200 rounded cursor-pointer has-[:checked]:outline has-[:checked]:outline-2">
				<input v-model="model" :id="option.id" type="radio" :value="option.value"
					class="w-4 h-4 text-gray-800 bg-gray-100 border-gray-300 focus:ring-black checked:ring-gray-800 checked:ring-2">

				<span class="ms-2">{{ option.label }}</span>
			</label>
		</div>
	</div>
</template>

<style scoped>
</style>
