<script setup>
import { storeToRefs } from 'pinia'
import { useModalStore } from '@/Stores/modals';

import BaseButton from '@/Components/Shared/BaseButton.vue'
import DeleteAccountModal from '@/Features/Profile/Components/DeleteAccountModal.vue';

const modalStore = useModalStore();
const { accountModalOpen } = storeToRefs(modalStore)
</script>

<template>
	<section class="space-y-6">
		<!-- <header>
			<h2 class="text-lg font-medium text-gray-900">Delete Account</h2>

			<p class="mt-1 text-sm text-gray-600">
				Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
				your account, please download any data or information that you wish to retain.
			</p>
		</header> -->

		<BaseButton variant="danger" @click="accountModalOpen = true">
			Delete Account
		</BaseButton>

		<DeleteAccountModal />
	</section>
</template>
