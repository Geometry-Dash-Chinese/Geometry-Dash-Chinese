<script lang="ts" setup>
import { router } from '@inertiajs/vue3'

const loadingBar = useLoadingBar()

router.on('start', () => {
	loadingBar.start()
})

router.on('error', () => {
	loadingBar.error()
})

router.on('finish', () => {
	loadingBar.finish()
})
</script>

<template/>