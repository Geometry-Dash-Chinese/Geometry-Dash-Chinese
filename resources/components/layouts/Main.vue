<script lang="ts" setup>
import GDCN from '@/assets/GDCN.png'
import GDCS from '@/assets/GDCS.png'
import GDProxy from '@/assets/GDProxy.png'
import NGProxy from '@/assets/NGProxy.png'
import { useAppStore } from '@/scripts/core/stores.ts'
import { darkTheme, dateZhCN, type MenuOption, NButton, NImage, zhCN } from 'naive-ui'

const appStore = useAppStore()

const theme = computed(() => {
	if (appStore.darkMode) {
		return darkTheme
	}

	return null
})

const menus: MenuOption[][] = [
	[
		{
			label: () => h(NButton, {
				text: true,
				tag: 'a',
				href: 'https://geometrydashchinese.com',
				focusable: false
			}, () => 'Geometry Dash Chinese'),
			key: 'GDCN',
			icon: () => h(NImage, {
				class: 'logo',
				src: GDCN
			})
		}
	],
	[
		{
			label: () => h(NButton, {
				text: true,
				tag: 'a',
				href: 'https://gf.geometrydashchinese.com',
				focusable: false
			}, () => 'Geometry Dash Chinese Server'),
			key: 'GDCS',
			icon: () => h(NImage, {
				class: 'logo',
				src: GDCS
			})
		},
		{
			label: () => h(NButton, {
				text: true,
				tag: 'a',
				href: 'https://dl.geometrydashchinese.com',
				focusable: false
			}, () => 'Geometry Dash Proxy'),
			key: 'GDProxy',
			icon: () => h(NImage, {
				class: 'logo',
				src: GDProxy
			})
		},
		{
			label: () => h(NButton, {
				text: true,
				tag: 'a',
				href: 'https://ng.geometrydashchinese.com',
				focusable: false
			}, () => 'Newgrounds Proxy'),
			key: 'NGProxy',
			icon: () => h(NImage, {
				class: 'logo',
				src: NGProxy
			})
		}
	]
]
</script>

<template>
	<n-config-provider :date-locale="dateZhCN" :locale="zhCN" :theme="theme">
		<n-dialog-provider>
			<n-loading-bar-provider>
				<n-message-provider>
					<n-notification-provider>
						<n-layout position="absolute">
							<n-layout-header>
								<slot name="header">
									<n-flex align="center" justify="space-between">
										<n-menu v-for="items in menus" :options="items" :value="null" class="!w-fit"
												mode="horizontal"/>
									</n-flex>
								</slot>
							</n-layout-header>

							<n-layout-content class="p-5">
								<slot/>
							</n-layout-content>

							<n-layout-footer class="p-2" position="absolute">
								<slot name="footer">
									<n-flex :size="0" align="center" class="text-center" justify="center">
										<n-text>&copy; 2024 - {{ new Date().getFullYear() }}</n-text>
										<n-divider vertical/>

										<n-text>Geometry Dash Chinese</n-text>
										<n-divider vertical/>

										<n-button href="https://beian.miit.gov.cn" tag="a" text>
											吉ICP备18006293号
										</n-button>
									</n-flex>
								</slot>
							</n-layout-footer>
						</n-layout>
					</n-notification-provider>
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