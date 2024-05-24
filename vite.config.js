import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';


export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',
                'resources/css/stripe.css',
                'resources/css/select2.css',
                'resources/css/custom-homeV2.css',
                'resources/js/app.js',
                'resources/js/homepage-v2.js',
                'resources/js/main.js',
                'resources/css/custom2.css',
                'resources/css/marketplace.css',
                'resources/js/collapse.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
            ],
        }),
    ],
});
