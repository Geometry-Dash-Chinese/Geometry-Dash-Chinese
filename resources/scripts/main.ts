import 'virtual:uno.css'

import { createInertiaApp } from '@inertiajs/vue3'
import { createPersistedState } from 'pinia-plugin-persistedstate'
import { createApp, type DefineComponent, h } from 'vue'

await createInertiaApp({
	resolve: async name => {
		const pages = import.meta.glob<DefineComponent>('@/pages/**/*.vue')
		const loader = pages[`/resources/pages/${name}.vue`]

		if (!isDefined(loader)) {
			throw new Error(`页面 ${name} 不存在`)
		}

		return await loader()
	},
	setup({ el, App, props, plugin }) {
		const app = createApp({
			render: () => h(App, props)
		})

		const pinia = createPinia()
		const persistedState = createPersistedState()

		pinia.use(persistedState)

		app.use(pinia)
		app.use(plugin)
		app.mount(el)
	}
})