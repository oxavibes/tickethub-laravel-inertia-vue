import { defineStore } from 'pinia'

export const useModalStore = defineStore('modals', {
	state: () => ({
		accountModalOpen: false,

		createUserModalOpen: false,
		editUserModalOpen: false,
		deleteUserModalOpen: false,

		createCategoryModalOpen: false,
		editCategoryModalOpen: false,
		deleteCategoryModalOpen: false,

		createLabelModalOpen: false,
		editLabelModalOpen: false,
		deleteLabelModalOpen: false,

		createTicketModalOpen: false,
		editTicketModalOpen: false,
		deleteTicketModalOpen: false,
	}),
	actions: {},
	getters: {
		isModalOpen: (state) => (modalId) => {
			return state[modalId] || false;
		},
	},
})
