import { defineConfig } from 'vite';
import { resolve } from 'path';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
	const DEV = mode === 'development';

	return {
		base: '/dist/',
		plugins: [vue()],
		resolve: {
			alias: {
				'@': resolve(__dirname, 'assets/js'),
				'~': resolve(__dirname, 'node_modules'),
			},
		},
		server: {
			open: false,
			hmr: false,
		},
		build: {
			manifest: true,
			assetsDir: '',
			outDir: './www/dist/',
			emptyOutDir: false,
			minify: DEV ? false : 'esbuild',
			rollupOptions: {
				output: {
					manualChunks: undefined,
					chunkFileNames: DEV ? '[name].js' : '[name]-[hash].js',
					entryFileNames: DEV ? '[name].js' : '[name].[hash].js',
					assetFileNames: DEV ? '[name].[ext]' : '[name].[hash].[ext]',
				},
				input: {
					site: './assets/js/site.ts',
					inertia: './assets/js/inertia.ts',
					vueDemo: './assets/js/vue-demo.ts',
				}
			}
		},
	}
});
