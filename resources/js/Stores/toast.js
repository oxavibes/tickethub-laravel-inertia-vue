import { defineStore } from 'pinia';

/**
 * Pinia store for managing toast notifications.
 * @typedef {Object} ToastStore
 * @property {Array<Object>} items - An array containing the toast items.
 */

/**
 * Create and define a Pinia store for managing toast notifications.
 * @function
 * @name useToastStore
 * @returns {ToastStore} The toast store instance.
 */
export const useToastStore = defineStore('toast', {
	/**
	 * State function returning the initial state of the toast store.
	 * @function
	 * @name state
	 * @returns {ToastStore} The initial state of the toast store.
	 */
	state: () => ({
		items: [],
	}),

	/**
	 * Getters for accessing computed properties derived from the state.
	 * @type {Object}
	 * @name getters
	 */
	getters: {},

	/**
	 * Actions for performing asynchronous operations and updating the state.
	 * @type {Object}
	 * @name actions
	 */
	actions: {
		/**
		 * Add a new toast item to the store.
		 * @function
		 * @name add
		 * @param {Object} toast - The toast object to be added.
		 */
		add(toast) {
			this.items.unshift({
				key: Symbol(),
				...toast,
			});
		},

		/**
		 * Remove a toast item from the store based on its index.
		 * @function
		 * @name remove
		 * @param {number} index - The index of the toast item to be removed.
		 */
		remove(index) {
			this.items.splice(index, 1);
		},
	},
});
