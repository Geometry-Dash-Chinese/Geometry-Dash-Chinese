<script lang="ts" setup>
import type { SharedPageProps } from '@/types/inertia'
import { usePage } from '@inertiajs/vue3'
import { breakpointsTailwind } from '@vueuse/core'
import type { MenuOption } from 'naive-ui'
import { first } from 'remeda'

const page = usePage<SharedPageProps>()

const props = defineProps<{
	readonly menus: MenuOption[][]
}>()

const breakpoints = useBreakpoints(breakpointsTailwind)
const isMobile = breakpoints.smaller('lg')

const menus = computed(() => {
	if (isMobile.value) {
		const menus = props.menus.flat()

		const mobileResult = {
			...first(menus),
			children: menus.slice(1)
		}

		return [[mobileResult]]
	}

	return props.menus
})
</script>

<template>
	<n-flex align="center" justify="space-between">
		<n-menu v-for="items in menus"
				:mode="(isMobile ? 'vertical' : 'horizontal')"
				:options="items" :value="page.props.current_route"
				class="w-full sm:!w-fit"/>
	</n-flex>
</template>