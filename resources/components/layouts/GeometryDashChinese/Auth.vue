<script lang="ts" setup>
import GeometryDashChineseLayout from '@/components/layouts/GeometryDashChinese.vue'
</script>

<template>
	<GeometryDashChineseLayout>
		<div class="sm:(flex justify-center items-center h-full)">
			<n-card class="sm:w-fit">
				<template #header>
					<div class="text-center">
						身份验证
					</div>
				</template>

				<slot/>
			</n-card>
		</div>
	</GeometryDashChineseLayout>
</template>