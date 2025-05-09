    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';
    import react from '@vitejs/plugin-react';
    import tailwindcss from '@tailwindcss/vite';
    import autoprefixer from 'autoprefixer';

    export default defineConfig({
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/main.jsx',
                ],
                refresh: true,
            }),
            react(),
            tailwindcss(),
        ],
        css: {
            postcss: {
                plugins: [
                    tailwindcss,
                    autoprefixer,
                ],
            },
        },
        build: {
            outDir: 'dist', // Configura aquí la carpeta de salida
        },
    });
