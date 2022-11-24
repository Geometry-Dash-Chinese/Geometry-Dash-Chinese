import {defineConfig} from "vite";
import legacy from "@vitejs/plugin-legacy";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import vueJsx from "@vitejs/plugin-vue-jsx";
import AutoImport from "unplugin-auto-import/vite";
import Components from "unplugin-vue-components/vite";
import {NaiveUiResolver} from "unplugin-vue-components/resolvers";
import InertiaLayoutApplier from "./resources/scripts/vite/inertia-layout";
import {short} from "git-rev-sync";
import {resolve as resolvePath} from "path";

export default defineConfig({
    base: 'https://cdn.geometrydashchinese.com/static/website/',
    build: {
        outDir: 'dist',
        minify: 'terser',
        terserOptions: {
            mangle: true
        }
    },
    esbuild: {
        jsxFactory: 'h',
        jsxFragment: 'Fragment'
    },
    resolve: {
        alias: {
            '@': resolvePath(__dirname, 'resources')
        }
    },
    plugins: [
        InertiaLayoutApplier(),
        laravel([
            'resources/styles/main.scss',
            'resources/scripts/main.ts',
        ]),
        vue(),
        vueJsx(),
        AutoImport({
            imports: [
                'vue',
                {
                    'naive-ui': [
                        'useDialog',
                        'useMessage',
                        'useNotification',
                        'useLoadingBar'
                    ]
                }
            ]
        }),
        Components({
            resolvers: [
                NaiveUiResolver()
            ]
        }),
        legacy({
            targets: [
                'defaults',
                'chrome 52',
                'ie >= 11'
            ],
            additionalLegacyPolyfills: [
                'regenerator-runtime/runtime'
            ]
        })
    ],
    define: {
        frontend_git_commit_hash: ` '${short()}' `.trim()
    }
})
