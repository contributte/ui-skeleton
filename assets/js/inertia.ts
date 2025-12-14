/**
 * Inertia.js Entry Point
 *
 * This file demonstrates how to set up Inertia.js with different frontend frameworks.
 * Uncomment the appropriate section based on your chosen framework.
 *
 * Installation:
 * - Vue 3:   npm install @inertiajs/vue3 vue
 * - React:   npm install @inertiajs/react react react-dom
 * - Svelte:  npm install @inertiajs/svelte svelte
 */

// CSS
import "./../css/tailwind.css";

// =============================================================================
// Vue 3 Setup
// =============================================================================
// import { createApp, h } from 'vue';
// import { createInertiaApp } from '@inertiajs/vue3';
//
// createInertiaApp({
// 	resolve: (name: string) => {
// 		// Eager loading
// 		const pages = import.meta.glob('./Pages/**/*.vue', { eager: true });
// 		return pages[`./Pages/${name}.vue`];
//
// 		// Lazy loading (recommended for larger apps)
// 		// const pages = import.meta.glob('./Pages/**/*.vue');
// 		// return pages[`./Pages/${name}.vue`]();
// 	},
// 	setup({ el, App, props, plugin }) {
// 		createApp({ render: () => h(App, props) })
// 			.use(plugin)
// 			.mount(el);
// 	},
// });

// =============================================================================
// React Setup
// =============================================================================
// import { createRoot } from 'react-dom/client';
// import { createInertiaApp } from '@inertiajs/react';
//
// createInertiaApp({
// 	resolve: (name: string) => {
// 		// Eager loading
// 		const pages = import.meta.glob('./Pages/**/*.tsx', { eager: true });
// 		return pages[`./Pages/${name}.tsx`];
//
// 		// Lazy loading
// 		// const pages = import.meta.glob('./Pages/**/*.tsx');
// 		// return pages[`./Pages/${name}.tsx`]();
// 	},
// 	setup({ el, App, props }) {
// 		createRoot(el).render(<App {...props} />);
// 	},
// });

// =============================================================================
// Svelte Setup
// =============================================================================
// import { createInertiaApp } from '@inertiajs/svelte';
//
// createInertiaApp({
// 	resolve: (name: string) => {
// 		const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true });
// 		return pages[`./Pages/${name}.svelte`];
// 	},
// 	setup({ el, App, props }) {
// 		new App({ target: el, props });
// 	},
// });

// =============================================================================
// Placeholder (remove when using a framework above)
// =============================================================================
console.log('Inertia.js entry point loaded. Configure your frontend framework in assets/js/inertia.ts');
