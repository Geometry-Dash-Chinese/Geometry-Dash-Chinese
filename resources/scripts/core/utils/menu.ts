import { Link } from '@inertiajs/vue3'
import type { MenuOption } from 'naive-ui'
import { route } from 'ziggy-js'

export const createRouteMenu = (label: string, routeName: string) => {
	const link = route(routeName)
	const isSameHost = new URL(link).host === location.host

	return {
		label: () => {
			if (!isSameHost) {
				return h('a', {
					href: link
				}, label)
			}

			return h(Link, {
				href: link
			}, () => label)
		},
		key: routeName
	} satisfies MenuOption
}