import { mount } from "@vue/test-utils";
import { describe, it, expect } from "vitest";

import Button from '@/Components/Shared/BaseButton.vue';

const wrapperFactory = ({ component, props = {} }) => {
	return mount(component, {
		props,
	});
};

describe('BaseButton.vue', () => {
	it('should render the button with default props', () => {
		const wrapper = wrapperFactory({ component: Button });

		expect(wrapper.exists()).toBe(true);
		expect(wrapper.disabled).toBeUndefined();
	});


	it('should render the loading text when is loading', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true,
			},
		})

		expect(wrapper.text()).toContain('Loading...');
	});

	it('should be disabled in loading state', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true
			},
		})

		expect(wrapper.attributes('disabled')).toBe('');
	});

	it('should be disabled if is in both loading state and disable state', () => {
		const wrapper = wrapperFactory({
			component: Button,
			props: {
				isLoading: true,
				isDisable: true
			},
		})

		expect(wrapper.attributes('disabled')).toBe('');
	});
});
