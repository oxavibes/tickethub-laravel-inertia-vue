import { onMounted, watch } from 'vue';
import { onClickOutside } from '@vueuse/core';

/**
 * Initialize a modal manager with click outside and scrollbar behavior.
 * @param {Object} options - Options for configuring the modal manager.
 * @param {Ref} options.target - The target element representing the modal.
 * @param {Ref} options.currentModalModel - The reactive variable controlling the modal's visibility.
 */
export default ({ target, currentModalModel }) => {
	/**
	 * Handle the behavior when the component is mounted.
	 * @function
	 */
	onMounted(() => {
		// Close the modal when clicking outside of it
		onClickOutside(target, event => currentModalModel.value = false);

		/**
		 * Watch for changes in the modal's visibility and adjust scrollbar behavior.
		 * @function
		 * @param {boolean} newValue - The new value of the modal's visibility.
		 */
		watch(currentModalModel, (newValue) => {
			// Add or remove the 'overflow-hidden' class from the body to hide or show the scrollbar
			if (newValue) {
				document.querySelector('body').classList.add('overflow-hidden');
			} else {
				document.querySelector('body').classList.remove('overflow-hidden');
			}
		});
	});
};
