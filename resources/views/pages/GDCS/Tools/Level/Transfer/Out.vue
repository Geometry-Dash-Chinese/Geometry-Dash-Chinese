<script lang="ts" setup>
import { FormInst, FormRules, NButton, NCard, NForm, NFormItem, NInput, NSelect } from 'naive-ui'
import { ref, watch } from 'vue'
import { useForm } from '@inertiajs/inertia-vue3'
import route from '@/scripts/route'
import { GDCS } from '@/scripts/types/backend'

defineProps<{
    levels: GDCS.Level[],
    links: GDCS.AccountLink[]
}>()

const el = ref<FormInst>()
const form = useForm({
  levelID: null,
  linkID: null,
  password: null
})

const rules = {
  levelID: {
    type: 'number',
    required: true,
    validator: () => Promise.reject(form.errors.levelID)
  },
  linkID: {
    type: 'number',
    required: true,
    validator: () => Promise.reject(form.errors.linkID)
  },
  password: {
    type: 'string',
    required: true,
    validator: () => Promise.reject(form.errors.password)
  }
} as FormRules

watch([el, form], () => {
  if (el.value) {
    el.value.validate()
  }
})

function submit () {
  form.post(
    route('gdcs.tools.level.transfer.out.api')
  )
}
</script>

<template layout="GDCS">
    <n-card class="lg:w-1/3 mx-auto" title="关卡转移(出)">
        <n-form ref="el" :model="form" :rules="rules">
            <n-form-item label="关卡" path="levelID">
                <n-select v-model:value="form.levelID" :options="levels"/>
            </n-form-item>

            <n-form-item label="账号" path="linkID">
                <n-select v-model:value="form.linkID" :options="links"/>
            </n-form-item>

            <n-form-item label="密码" path="password">
                <n-input v-model:value="form.password" type="password"/>
            </n-form-item>

            <n-button :disabled="form.processing" @click="submit">
                提交
            </n-button>
        </n-form>
    </n-card>
</template>
