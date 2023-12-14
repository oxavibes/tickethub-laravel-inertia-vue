import { defineStore } from 'pinia'

export const useModalStore = defineStore('modals', {
	state: () => ({
		modals: {},
	}),
	actions: {
		openModal(modalId) {
			this.modals[modalId] = true;
		},
		closeModal(modalId) {
			this.modals[modalId] = false;
		},
	},
	getters: {
		isModalOpen: (state) => (modalId) => {
			return state.modals[modalId] || false;
		},
	},
})
