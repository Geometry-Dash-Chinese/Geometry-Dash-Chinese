import { useOsTheme } from 'naive-ui'

export const useAppStore = defineStore('app', {
	state: () => ({
		darkMode: useOsTheme().value === 'dark'
	})
})