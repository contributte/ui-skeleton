import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

const pages = import.meta.glob("./pages/**/*.vue");

void createInertiaApp({
	resolve: async (name) => {
		const page = pages[`./pages/${name}.vue`];

		if (!page) {
			throw new Error(`Unknown Inertia page: ${name}`);
		}

		return await page();
	},
	setup({ el, App, props, plugin }) {
		createApp({ render: () => h(App, props) })
			.use(plugin)
			.mount(el);
	},
});
