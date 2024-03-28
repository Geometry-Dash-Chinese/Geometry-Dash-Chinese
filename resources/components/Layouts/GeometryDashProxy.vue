<script lang="ts" setup>
import GeometryDashProxy from '@/assets/GeometryDashProxy.png'
import GeometryDashChineseLayout from '@/components/Layouts/GeometryDashChinese.vue'
import Menu from '@/components/Shared/Menu.vue'
import { createRouteMenu } from '@/scripts/core/utils/menu.ts'
import type { SharedPageProps } from '@/types/inertia'
import { usePage } from '@inertiajs/vue3'
import { LoginOutlined, LogoutOutlined, ProfileOutlined, ToolOutlined, UserOutlined } from '@vicons/antd'
import { NIcon, NImage } from 'naive-ui'

const page = usePage<SharedPageProps & {
	readonly user: Models.User | null
}>()

const menus = computed(() => {
	return [
		[
			{
				...createRouteMenu('Geometry Dash Proxy', 'GeometryDashProxy.home'),
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashProxy
				})
			}
		],
		[
			{
				...createRouteMenu('工具', 'GeometryDashProxy.tools.home'),
				icon: () => h(NIcon, {
					component: ToolOutlined
				})
			}
		],
		[
			isDefined(page.props.user) ?
				{
					label: page.props.user.name,
					key: 'user',
					icon: () => h(NIcon, {
						component: UserOutlined
					}),
					children: [
						{
							...createRouteMenu('个人资料', 'GeometryDashChinese.user.profile'),
							icon: () => h(NIcon, {
								component: ProfileOutlined
							})
						},
						{
							...createRouteMenu('登出', 'GeometryDashChinese.user.logout.api'),
							icon: () => h(NIcon, {
								component: LogoutOutlined
							})
						}
					]
				} :
				{
					...createRouteMenu('登录', 'GeometryDashChinese.auth.login'),
					icon: () => h(NIcon, {
						component: LoginOutlined
					})
				}
		]
	]
})
</script>

<template>
	<GeometryDashChineseLayout>
		<template #header>
			<Menu :menus="menus"/>
		</template>

		<slot/>
	</GeometryDashChineseLayout>
</template>