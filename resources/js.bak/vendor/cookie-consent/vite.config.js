import { resolve } from 'node:path'

import { defineConfig }   from 'vite'
import { viteStaticCopy } from "vite-plugin-static-copy";
export default defineConfig({
    build: {
        target: "es2019",
        outDir: 'dir',
        emptyOutDir: false,
        sourcemap: false,
        manifest: false,
        rollupOptions: {
            output: {
                extend: true,
                entryFileNames: 'js/cookie-consent.min.js',
                assetFileNames: '[ext]/cookie-consent.min.[ext]'
            }
        },
        lib: {
            entry: resolve(__dirname, 'cookie-consent.js'),
            formats: ['iife'],
            name: 'cookie-consent',
            fileName: 'index',
        },
        esbuild: {
            target: "es2019"
        },
        optimizeDeps: {
            esbuildOptions: {
                target: "es2019",
            }
        }
    },
    plugins: [
        viteStaticCopy({
            targets: [
                {
                    src: 'dir/js/cookie-consent.min.js',
                    dest: '../../../../../public_html/vendor/cookie-consent/js',
                },
                {
                    src: 'dir/css/cookie-consent.min.css',
                    dest: '../../../../../public_html/vendor/cookie-consent/css',
                },
            ]
        })
    ]
})