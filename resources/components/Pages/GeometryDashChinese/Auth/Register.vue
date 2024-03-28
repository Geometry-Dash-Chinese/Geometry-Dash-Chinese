<script lang="ts">
import GeometryDashChineseAuthLayout from '@/components/Layouts/GeometryDashChinese/Auth.vue'

export default {
	layout: GeometryDashChineseAuthLayout
}
</script>

<script lang="ts" setup>
import { createFormItemAttribute } from '@/scripts/core/utils/form.ts'
import { useForm, usePage, router } from '@inertiajs/vue3'
import { isNonNullish } from 'remeda'
import { route } from 'ziggy-js'

const form = useForm({
	name: null,
	email: null,
	password: null,
	password_confirmation: null
})

const valid = computed(() => {
	return isNonNullish(form.name) && isNonNullish(form.email) && isNonNullish(form.password) && isNonNullish(form.password_confirmation) && !form.processing
})

const submit = () => {
	form.post(route('GeometryDashChinese.auth.register.api'))
}
</script>

<template>
	<n-form class="flex flex-col gap-2.5">
		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'name')">
			<n-input v-model:value="form.name" placeholder="用户名"/>
		</n-form-item>

		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'email')">
			<n-input v-model:value="form.email" placeholder="邮箱"/>
		</n-form-item>

		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'password')">
			<n-input v-model:value="form.password" placeholder="密码" show-password-on="mousedown"
					 type="password"/>
		</n-form-item>

		<n-form-item :show-label="false" v-bind="createFormItemAttribute(form, 'password_confirmation')">
			<n-input v-model:value="form.password_confirmation" placeholder="密码确认" show-password-on="mousedown"
					 type="password"/>
		</n-form-item>

		<n-form-item :show-feedback="false" :show-label="false">
			<n-button :disabled="!valid" class="w-1/2 mx-auto" @click="submit">注册</n-button>
		</n-form-item>
	</n-form>

	<div class="text-center mt-5">
		<n-button text type="primary" @click="router.visit(route('GeometryDashChinese.auth.login'))">
			已有账号? 去登录
		</n-button>
	</div>
</template>