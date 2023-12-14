import { onMounted, watch } from 'vue'
import { onClickOutside } from '@vueuse/core'

export default ({ target, currentModalModel }) => {
	onMounted(() => {
		onClickOutside(target, event => currentModalModel.value = false)

		// Hide the scrollbar when a modal is opened
		watch(currentModalModel, (newValue) => {
			if (newValue)
				document.querySelector('body').classList.add('overflow-hidden')

			else
				document.querySelector('body').classList.remove('overflow-hidden')
		})
	})
}
