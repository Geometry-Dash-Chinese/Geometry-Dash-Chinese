<script lang="ts" setup>
import GeometryDashChinese from '@/assets/GeometryDashChinese.png'
import GeometryDashChineseServer from '@/assets/GeometryDashChineseServer.png'
import GeometryDashProxy from '@/assets/GeometryDashProxy.png'
import NewgroundsProxy from '@/assets/NewgroundsProxy.png'
import Menu from '@/components/Shared/Menu.vue'
import ProgressWrapper from '@/components/Shared/ProgressWrapper.vue'
import { useAppStore } from '@/scripts/core/stores.ts'
import { createRouteMenu } from '@/scripts/core/utils/menu.ts'
import type { SharedPageProps } from '@/types/inertia'
import { usePage } from '@inertiajs/vue3'
import { LoginOutlined, LogoutOutlined, ProfileOutlined, UserOutlined } from '@vicons/antd'
import { darkTheme, dateZhCN, NIcon, NImage, zhCN } from 'naive-ui'

useFavicon(GeometryDashChinese)

const page = usePage<SharedPageProps & {
	readonly user: Models.User | null
}>()

const appStore = useAppStore()

const theme = computed(() => {
	if (appStore.darkMode) {
		return darkTheme
	}

	return null
})

const menus = computed(() => {
	return [
		[
			{
				...createRouteMenu('Geometry Dash Chinese', 'GeometryDashChinese.home'),
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashChinese
				})
			}
		],
		[
			{
				...createRouteMenu('Geometry Dash Chinese Server', 'GeometryDashChineseServer.home'),
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashChineseServer
				})
			},
			{
				...createRouteMenu('Geometry Dash Proxy', 'GeometryDashProxy.home'),
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashProxy
				})
			},
			{
				...createRouteMenu('Newgrounds Proxy', 'NewgroundsProxy.home'),
				icon: () => h(NImage, {
					class: 'logo',
					src: NewgroundsProxy
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
	<n-config-provider :date-locale="dateZhCN" :locale="zhCN" :theme="theme">
		<n-dialog-provider>
			<n-loading-bar-provider>
				<n-message-provider>
					<n-modal-provider>
						<n-notification-provider>
							<ProgressWrapper/>

							<n-layout position="absolute">
								<n-layout-header>
									<slot name="header">
										<Menu :menus="menus"/>
									</slot>
								</n-layout-header>

								<n-layout-content class="p-2 h-full">
									<Transition appear mode="out-in" name="page">
										<slot :key="$page.url"/>
									</Transition>
								</n-layout-content>

								<n-layout-footer class="p-2">
									<slot name="footer">
										<n-flex :size="0" align="center" class="text-center <sm:[&_*]:!text-sm"
												justify="center">
											<n-text>&copy; 2024 - {{ new Date().getFullYear() }}</n-text>
											<n-divider vertical/>

											<n-button
												href="https://github.com/Geometry-Dash-Chinese/Geometry-Dash-Chinese"
												tag="a" text>
												Geometry Dash Chinese
											</n-button>

											<n-divider vertical/>

											<n-button href="https://beian.miit.gov.cn" tag="a" text>
												吉ICP备18006293号
											</n-button>
										</n-flex>
									</slot>
								</n-layout-footer>
							</n-layout>
						</n-notification-provider>
					</n-modal-provider>
				</n-message-provider>
			</n-loading-bar-provider>
		</n-dialog-provider>
	</n-config-provider>
</template>

<style>
.page-enter-active,
.page-leave-active {
	@apply transition-(all duration-300) ease-in-out;
}

.page-enter-from,
.page-leave-to {
	@apply opacity-0 blur;
}
</style>

<style lang="scss">
.logo {
	@apply w-8 h-8 rounded;
}
</style>