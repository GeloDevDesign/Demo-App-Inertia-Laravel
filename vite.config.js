import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vueDevTools from 'vite-plugin-vue-devtools'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        vueDevTools(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    
});
