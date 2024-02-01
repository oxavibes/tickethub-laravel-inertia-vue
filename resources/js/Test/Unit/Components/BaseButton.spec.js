import { mount } from "@vue/test-utils";
import { describe, it, expect } from "vitest";

import Button from '@/Components/Shared/BaseButton.vue';

/**
 * Factory function to create a wrapper for testing a component with specified props.
 * @function
 * @param {Object} options - Options for configuring the wrapper.
 * @param {Component} options.component - The Vue component to be mounted.
 * @param {Object} [options.props] - Props to be passed to the mounted component.
 * @returns {Wrapper} The mounted wrapper for testing.
 */
const wrapperFactory = ({ component, props = {} }) => {
	return mount(component, {
		props,
	});
};

describe('BaseButton.vue', () => {
	/**
	 * Test case: The button should render with default props.
	 * @function
	 */
	it('should render the button with default props', () => {
		const wrapper = wrapperFactory({ component: Button });

		// Assert that the button exists and the 'disabled' prop is undefined
		expect(wrapper.exists()).toBe(true);
		expect(wrapper.props().disabled).toBeUndefined();
	});

	/**
	 * Test case: The loading text should be rendered when the button is in the loading state.
	 * @function
	 */
	it('should render the loading text when in loading state', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true,
			},
		});

		// Assert that the button text contains 'Loading...'
		expect(wrapper.text()).toContain('Loading...');
	});

	/**
	 * Test case: The button should be disabled in the loading state.
	 * @function
	 */
	it('should be disabled in loading state', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true,
			},
		});

		// Assert that the 'disabled' attribute is present
		expect(wrapper.attributes('disabled')).toBe('');
	});

	/**
	 * Test case: The button should be disabled if it is both in the loading and disable states.
	 * @function
	 */
	it('should be disabled if in both loading and disable states', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true,
				isDisable: true,
			},
		});

		// Assert that the 'disabled' attribute is present
		expect(wrapper.attributes('disabled')).toBe('');
	});
});
