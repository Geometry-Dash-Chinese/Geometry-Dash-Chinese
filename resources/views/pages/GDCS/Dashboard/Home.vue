<script lang="ts" setup>
import {NButton, NCard, NList, NListItem, NSpace, NStatistic, NTabPane, NTabs, NText, NThing} from "naive-ui"
import {formatTime, getProp, isMobile, toRouteWithParams} from "@/scripts/helpers"
import {GDCS} from "@/scripts/types/backend"
import {Inertia} from "@inertiajs/inertia"

defineProps<{
    todayRegisteredAccountCount: number,
    todayUploadedLevelCount: number,
    todayRatedLevelCount: number,
    recentRegisteredAccounts: GDCS.Account[],
    recentUploadedLevels: GDCS.Level[],
}>()

const leaderboards = getProp<GDCS.User[]>('leaderboards')
const recentRatedLevels = getProp<GDCS.Level[]>('recentRatedLevels')
const recentFeaturedLevels = getProp<GDCS.Level[]>('recentFeaturedLevels')
const recentEpicLevels = getProp<GDCS.Level[]>('recentEpicLevels')

function handleAccountTabsUpdate(newTab: string) {
    if (newTab === 'leaderboard') {
        Inertia.reload({
            only: ['leaderboards']
        })
    }
}

function handleLevelTabsUpdate(newTab: string) {
    switch (newTab) {
        case 'rated':
            Inertia.reload({
                only: ['recentRatedLevels']
            })
            break
        case 'featured':
            Inertia.reload({
                only: ['recentFeaturedLevels']
            })
            break
        case 'epic':
            Inertia.reload({
                only: ['recentEpicLevels']
            })
            break
    }
}
</script>

<template layout="GDCS">
    <n-space vertical>
        <n-card class="lg:w-1/2 mx-auto" title="今日动态">
            <n-space justify="space-evenly">
                <n-statistic label="新增账号">
                    {{ todayRegisteredAccountCount }}
                </n-statistic>

                <n-statistic label="新增关卡">
                    {{ todayUploadedLevelCount }}
                </n-statistic>

                <n-statistic label="新增 Rated 关卡">
                    {{ todayRatedLevelCount }}
                </n-statistic>
            </n-space>
        </n-card>

        <n-space :vertical="isMobile" justify="center">
            <n-card class="lg:w-[50rem]" title="账号">
                <n-tabs default-value="recent" justify-content="space-evenly" type="line"
                        @update:value="handleAccountTabsUpdate">
                    <n-tab-pane name="recent" tab="最近注册">
                        <n-list>
                            <n-list-item v-for="account in recentRegisteredAccounts">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.account.info', account.id)">
                                            {{ account.name }}
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">注册时间: {{ formatTime(account.created_at, '未知') }}</n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.account.info', account.id)">
                                            查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>

                    <n-tab-pane name="leaderboard" tab="排行榜">
                        <n-list>
                            <n-list-item v-for="score in leaderboards">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.user.info', score.user.id)">
                                            {{ score.user.name }}
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">{{ score.stars }} Stars</n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.user.info', score.user.id)">
                                            查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>
                </n-tabs>
            </n-card>

            <n-card class="lg:w-[50rem]" title="关卡">
                <n-tabs :justify-content="(isMobile ? 'space-between': 'space-evenly')" default-value="recent"
                        type="line"
                        @update:value="handleLevelTabsUpdate">
                    <n-tab-pane name="recent" tab="最近上传">
                        <n-list>
                            <n-list-item v-for="level in recentUploadedLevels">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">
                                            {{ level.name }} [{{ level.id }}]
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">
                                            <span>By </span>
                                            <n-button
                                                text
                                                @click="toRouteWithParams('gdcs.dashboard.user.info', level.user.id)">
                                                {{ level.user.name }}
                                            </n-button>
                                            <span>, </span>
                                            <span>上传时间: {{ formatTime(level.created_at, '未知') }}</span>
                                        </n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>

                    <n-tab-pane name="rated" tab="最近 Rated">
                        <n-list>
                            <n-list-item v-for="level in recentRatedLevels">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">
                                            {{ level.name }} [{{ level.id }}]
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">
                                            <span>By </span>
                                            <n-button
                                                text
                                                @click="toRouteWithParams('gdcs.dashboard.user.info', level.user.id)">
                                                {{ level.user.name }}
                                            </n-button>
                                            <span>, </span>
                                            <span>上传时间: {{ formatTime(level.created_at, '未知') }}</span>
                                        </n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>

                    <n-tab-pane name="featured" tab="最近 Featured">
                        <n-list>
                            <n-list-item v-for="level in recentFeaturedLevels">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">
                                            {{ level.name }} [{{ level.id }}]
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">
                                            <span>By </span>
                                            <n-button
                                                text
                                                @click="toRouteWithParams('gdcs.dashboard.user.info', level.user.id)">
                                                {{ level.user.name }}
                                            </n-button>
                                            <span>, </span>
                                            <span>上传时间: {{ formatTime(level.created_at, '未知') }}</span>
                                        </n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>

                    <n-tab-pane name="epic" tab="最近 Epic">
                        <n-list>
                            <n-list-item v-for="level in recentEpicLevels">
                                <n-thing>
                                    <template #header>
                                        <n-button text
                                                  @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">
                                            {{ level.name }} [{{ level.id }}]
                                        </n-button>
                                    </template>

                                    <template #description>
                                        <n-text :depth="3">
                                            <span>By </span>
                                            <n-button
                                                text
                                                @click="toRouteWithParams('gdcs.dashboard.user.info', level.user.id)">
                                                {{ level.user.name }}
                                            </n-button>
                                            <span>, </span>
                                            <span>上传时间: {{ formatTime(level.created_at, '未知') }}</span>
                                        </n-text>
                                    </template>
                                </n-thing>

                                <template #suffix>
                                    <n-space vertical>
                                        <n-button @click="toRouteWithParams('gdcs.dashboard.level.info', level.id)">查看
                                        </n-button>
                                    </n-space>
                                </template>
                            </n-list-item>
                        </n-list>
                    </n-tab-pane>
                </n-tabs>
            </n-card>
        </n-space>
    </n-space>
</template>
