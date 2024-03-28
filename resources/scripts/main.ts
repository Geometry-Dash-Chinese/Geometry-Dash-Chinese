import 'virtual:uno.css'

import { createInertiaApp } from '@inertiajs/vue3'
import { createPersistedState } from 'pinia-plugin-persistedstate'
import { createApp, type DefineComponent, h } from 'vue'
import { ZiggyVue } from 'ziggy-js'

await createInertiaApp({
	progress: false,
	resolve: async name => {
		const pages = import.meta.glob<DefineComponent>('@/components/Pages/**/*.vue')
		const loader = pages[`/resources/components/Pages/${name}.vue`]

		if (!isDefined(loader)) {
			throw new Error(`页面 ${name} 不存在`)
		}

		return await loader()
	},
	title: (() => {
		const title = document.title
		return (name: string) => `[${title}] ${name}`
	})(),
	setup({ el, App, props, plugin }) {
		const app = createApp({
			render: () => h(App, props)
		})

		const pinia = createPinia()
		const persistedState = createPersistedState()

		pinia.use(persistedState)

		app.use(pinia)
		app.use(plugin)
		app.use(ZiggyVue)

		app.mount(el)
	}
})