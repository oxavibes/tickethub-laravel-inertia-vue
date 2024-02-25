<script setup>
import heroImage from "@/../images/people-right.webp"

import BaseLink from '@/Components/Shared/BaseLink.vue';

defineProps({
	canLogin: {
		type: Boolean,
	},
	canRegister: {
		type: Boolean,
	},
	laravelVersion: {
		type: String,
		required: true,
	},
	phpVersion: {
		type: String,
		required: true,
	},
});
</script>

<template>
	<Head title="Welcome" />

	<div class="relative h-screen max-w-screen-xl px-5 mx-auto">
		<header class="flex flex-col items-center justify-between py-5 lg:flex-row">
			<div class="flex items-center justify-between w-full">
				<Link :href="route('welcome')" class="text-lg">
				<span class="font-bold text-slate-800">TicketHub</span>
				</Link>

				<div class="flex items-center gap-4 ">
					<Link :href="route('login')" class="text-base inertia-link">
					Log in
					</Link>

					<BaseLink :href="route('register')">
						Register
					</BaseLink>
				</div>
			</div>
		</header>

		<div class="w-full mx-auto lg:flex lg:items-center lg:justify-center lg:h-[calc(100vh-74px)]">
			<main class="grid pb-8 place-items-center lg:grid-cols-2">
				<div class="block pb-12 order-0 lg:order-1 lg:pb-0">
					<picture>
						<source :srcset="`${heroImage} 200w, ${heroImage} 400w, ${heroImage} 600w`" type="image/webp"
							sizes="(max-width: 800px) 100vw, 620px">
						<img :src="`${heroImage}`" :srcset="`${heroImage} 200w, ${heroImage} 400w, ${heroImage} 600w`"
							alt="Two people talking each other" sizes="(max-width: 800px) 100vw, 620px" loading="eager" width="520"
							height="673" decoding="async">
					</picture>
				</div>

				<div class="space-y-6">
					<h1
						class="text-4xl font-bold text-gray-900 text-balance lg:text-6xl xl:text-7xl lg:tracking-tight xl:tracking-tighter">
						Elevate Support Experiences with TicketHub
					</h1>

					<p class="max-w-xl lg:text-lg text-slate-500 text-pretty">
						TicketHub is your all-in-one support ticket solution. It provides everything you need for seamless support
						management, combining the best features of modern tools with its own innovative approach. Say goodbye to
						support challenges and hello to a smoother, more efficient support experience.
					</p>

					<div class="flex flex-col gap-3 sm:flex-row">
						<BaseLink size="sm" :href="route('register')">
							Get started
						</BaseLink>
					</div>
				</div>
			</main>
		</div>
	</div>
</template>

<style scoped>
</style>
