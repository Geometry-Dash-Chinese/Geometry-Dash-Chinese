import Vue from '@vitejs/plugin-vue'
import Laravel from 'laravel-vite-plugin'
import { resolve } from 'node:path'
import UnoCSS from 'unocss/vite'
import AutoImport from 'unplugin-auto-import/vite'
import { NaiveUiResolver } from 'unplugin-vue-components/resolvers'
import Components from 'unplugin-vue-components/vite'
import { defineConfig } from 'vite'

export default defineConfig({
	resolve: {
		alias: {
			'@': resolve(__dirname, 'resources')
		}
	},
	plugins: [
		UnoCSS(),
		AutoImport({
			imports: [
				'vue',
				'pinia',
				'@vueuse/core',
				{
					'naive-ui': [
						'useDialog',
						'useMessage',
						'useNotification',
						'useLoadingBar'
					]
				}
			]
		}),
		Components({
			resolvers: [
				NaiveUiResolver()
			]
		}),
		Vue(),
		Laravel({
			input: ['resources/scripts/main.ts'],
			refresh: true
		})
	]
})