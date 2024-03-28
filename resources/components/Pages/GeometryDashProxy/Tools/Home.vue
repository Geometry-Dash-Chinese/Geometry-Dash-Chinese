<script lang="ts">
import GeometryDashProxyLayout from '@/components/Layouts/GeometryDashProxy.vue'

export default {
	layout: GeometryDashProxyLayout
}
</script>

<script lang="ts" setup>
import { Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const [] = createReusableTemplate<{
	readonly href: string
}>()
</script>

<template>
	<div class="container mx-auto">
		<n-flex justify="center">
			<n-card title="账号工具">
				<Link :href="route('GeometryDashProxy.tools.account.binding-token.create')">
					<n-button>创建绑定令牌</n-button>
				</Link>
			</n-card>
		</n-flex>
	</div>
</template>