<script lang="ts">
import GeometryDashProxyLayout from '@/components/Layouts/GeometryDashProxy.vue'

export default {
	layout: GeometryDashProxyLayout
}
</script>

<script lang="ts" setup>
import { Link, router } from '@inertiajs/vue3'
import { tryOnMounted } from '@vueuse/core'
import { isNonNullish, isNullish } from 'remeda'
import { route } from 'ziggy-js'

const props = defineProps<{
	readonly record: Models.GeometryDashProxyGameAccountBindingToken
}>()

watch(() => props.record, newRecord => {
	if (isNonNullish(newRecord)) {
		const interval = setInterval(() => {
			if (new Date(newRecord.expired_at) < new Date()) {
				clearInterval(interval)
				router.reload()
			}
		}, 500)
	}
}, {
	immediate: true
})
</script>

<template>
	<div class="container mx-auto">
		<n-card title="账号绑定令牌">
			<template v-if="isNonNullish(record)">
				<n-flex class="text-center" vertical>
					<n-text class="text-4xl fw-bold">{{ record.token }}</n-text>

					<n-text :depth="3">
						{{ record.expired_at }}
					</n-text>
				</n-flex>
			</template>

			<template v-else>
				<Link :href="route('GeometryDashProxy.tools.account.binding-token.create.api')" as="span" method="post">
					<n-button>点击生成</n-button>
				</Link>
			</template>
		</n-card>
	</div>
</template>