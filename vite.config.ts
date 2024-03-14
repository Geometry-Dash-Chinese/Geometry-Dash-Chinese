import laravel from 'laravel-vite-plugin'
import { resolve } from 'node:path'
import { defineConfig } from 'vite'

export default defineConfig({
	resolve: {
		alias: {
			'@': resolve(__dirname, 'src')
		}
	},
	plugins: [
		laravel({
			input: ['resources/css/app.css', 'resources/js/app.js'],
			refresh: true
		})
	]
})