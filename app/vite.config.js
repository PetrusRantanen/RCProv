import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Nunito', {
                    weights: [200, 300, 500, 600, 700, 900],
                    styles: ['normal', 'italic']
                }),
            ],
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: ['if-function'],
                sassOptions: { quietDeps: true },
            },
            sass: {
                silenceDeprecations: ['if-function'],
                sassOptions: { quietDeps: true },
            },
        },
    },
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
