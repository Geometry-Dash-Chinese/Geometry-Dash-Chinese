<script lang="ts">
import GeometryDashChineseLayout from '@/components/layouts/GeometryDashChinese.vue'

export default {
	layout: GeometryDashChineseLayout
}
</script>

<script lang="ts" setup>
import { isNullish } from 'remeda'

defineProps<{
	readonly user: Models.User
}>()
</script>

<template>
	<n-flex class="sm:(container mx-auto)" vertical>
		<n-alert v-if="isNullish(user.email_verified_at)" type="error">
			邮箱未验证
		</n-alert>

		<n-card :title="user.name">
			ID: {{ user.id }}
			<br>
			邮箱: {{ user.email }}
			<br>
			注册时间: {{ new Date(user.created_at).toLocaleString() }}
		</n-card>
	</n-flex>
</template>