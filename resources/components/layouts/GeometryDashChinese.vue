<script lang="ts" setup>
import GeometryDashChinese from '@/assets/GeometryDashChinese.png'
import GeometryDashChineseServer from '@/assets/GeometryDashChineseServer.png'
import GeometryDashProxy from '@/assets/GeometryDashProxy.png'
import NewgroundsProxy from '@/assets/NewgroundsProxy.png'
import { useAppStore } from '@/scripts/core/stores.ts'
import { Link, usePage } from '@inertiajs/vue3'
import { LoginOutlined, LogoutOutlined, ProfileOutlined, UserOutlined } from '@vicons/antd'
import { breakpointsTailwind } from '@vueuse/core'
import { darkTheme, dateZhCN, type MenuOption, NIcon, NImage, zhCN } from 'naive-ui'
import { first } from 'remeda'

useFavicon(GeometryDashChinese)

const page = usePage<{
	readonly user: Models.User | null
	readonly current_route: string

	readonly links: {
		readonly GeometryDashChinese: string
		readonly GeometryDashChineseServer: string
		readonly GeometryDashProxy: string
		readonly NewgroundsProxy: string

		readonly AuthLogin: string
		readonly AuthRegister: string

		readonly UserProfile: string
		readonly UserLogoutApi: string
	}
}>()

const appStore = useAppStore()

const theme = computed(() => {
	if (appStore.darkMode) {
		return darkTheme
	}

	return null
})

const breakpoints = useBreakpoints(breakpointsTailwind)
const isMobile = breakpoints.smaller('lg')

const menus = computed(() => {
	const result: [
		brand: MenuOption[],
		products: MenuOption[],
		auth: MenuOption[]
	] = [
		[
			{
				label: () => h(Link, {
					href: page.props.links.GeometryDashChinese
				}, () => 'Geometry Dash Chinese'),
				key: 'GeometryDashChinese.home',
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashChinese
				})
			}
		],
		[
			{
				label: () => h('a', {
					href: page.props.links.GeometryDashChineseServer
				}, 'Geometry Dash Chinese Server'),
				key: 'GeometryDashChineseServer.home',
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashChineseServer
				})
			},
			{
				label: () => h('a', {
					href: page.props.links.GeometryDashProxy
				}, 'Geometry Dash Proxy'),
				key: 'GeometryDashProxy.home',
				icon: () => h(NImage, {
					class: 'logo',
					src: GeometryDashProxy
				})
			},
			{
				label: () => h('a', {
					href: page.props.links.NewgroundsProxy
				}, 'Newgrounds Proxy'),
				key: 'NewgroundsProxy.home',
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
							label: () => h(Link, {
								href: page.props.links.UserProfile
							}, () => '个人资料'),
							key: 'GeometryDashChinese.user.profile',
							icon: () => h(NIcon, {
								component: ProfileOutlined
							})
						},
						{
							label: () => h(Link, {
								method: 'delete',
								href: page.props.links.UserLogoutApi
							}, () => '登出'),
							key: 'GeometryDashChinese.user.logout.api',
							icon: () => h(NIcon, {
								component: LogoutOutlined
							})
						}
					]
				} :
				{
					label: () => h(Link, {
						href: page.props.links.AuthLogin
					}, () => '登录'),
					key: 'GeometryDashChinese.auth.login',
					icon: () => h(NIcon, {
						component: LoginOutlined
					})
				}
		]
	]

	if (isMobile.value) {
		const menus = result.flat()

		const mobileResult = {
			...first(menus),
			children: menus.slice(1)
		}

		return [[mobileResult]]
	}

	return result
})
</script>

<template>
	<n-config-provider :date-locale="dateZhCN" :locale="zhCN" :theme="theme">
		<n-dialog-provider>
			<n-loading-bar-provider>
				<n-message-provider>
					<n-modal-provider>
						<n-notification-provider>
							<n-layout position="absolute">
								<n-layout-header>
									<slot name="header">
										<n-flex align="center" justify="space-between">
											<n-menu v-for="items in menus"
													:mode="(isMobile ? 'vertical' : 'horizontal')"
													:options="items" :value="page.props.current_route"
													class="w-full sm:!w-fit"/>
										</n-flex>
									</slot>
								</n-layout-header>

								<n-layout-content class="p-2 h-full">
									<slot/>
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

<style lang="scss">
.logo {
	@apply w-8 h-8 rounded;
}
</style>