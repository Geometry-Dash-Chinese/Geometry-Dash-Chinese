<script lang="ts">
import GeometryDashChineseAuthLayout from '@/components/layouts/GeometryDashChinese/Auth.vue'

export default {
	layout: GeometryDashChineseAuthLayout
}
</script>

<script lang="ts" setup>
import { createFormItemAttribute } from '@/scripts/core/utils/form.ts'
import { useForm, usePage } from '@inertiajs/vue3'
import { isNonNullish } from 'remeda'

const page = usePage<{
	readonly links: {
		readonly AuthLogin: string
		readonly AuthRegister: string
	}
}>()

const form = useForm({
	name: null,
	password: null
})

const valid = computed(() => {
	return isNonNullish(form.name) && isNonNullish(form.password) && !form.processing
})

const submit = () => {
	form.post(page.props.links.AuthLogin)
}
</script>

<template>
	<n-form class="flex flex-col gap-2.5">
		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'name')">
			<n-input v-model:value="form.name" placeholder="用户名"/>
		</n-form-item>

		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'password')">
			<n-input v-model:value="form.password" placeholder="密码" show-password-on="mousedown"
					 type="password"/>
		</n-form-item>

		<n-form-item :show-feedback="false" :show-label="false">
			<n-button :disabled="!valid" class="w-1/2 mx-auto" @click="submit">登录</n-button>
		</n-form-item>
	</n-form>

	<div class="text-center mt-5">
		<n-button :href="page.props.links.AuthRegister" tag="a" text type="primary">
			没有账号? 去注册
		</n-button>
	</div>
</template>