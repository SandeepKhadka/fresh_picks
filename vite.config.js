import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// import jQuery from "jquery";
// window.$ = jQuery;
import path from 'path'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/js/app.js',
                'resources/js/admin.js',
                // 'template/vendors/DataTables/datatables.min.css',
                // 'template/vendors/DataTables/datatables.min.js'
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
    // server: {
    //     https: true,
    //     host: 'localhost',
    // },

});
