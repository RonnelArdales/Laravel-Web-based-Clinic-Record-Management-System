import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/Admin_Secretary/style.css',
                    'resources/css/user/style.css',
                    'resources/js//app.js',
                    'resources/js/admin/user.js',
                    'resources/js/admin/document.js',
                    'resources/js/admin/consultation/create.js',
                    'resources/js/admin/consultation/index.js',
                    'resources/js/admin/consultation/view.js',
                    'resources/js/secretary/user.js',
                    'resources/js/admin_secretary/pending.js',
                    'resources/js/admin_secretary/appointment.js',
                    'resources/js/admin_secretary/queuing.js',
                    'resources/js/admin_secretary/transaction.js',
                    'resources/js/admin_secretary/billing.js',
                    'resources/js/system_settings/service.js',
                    'resources/js/system_settings/discount.js',
                    'resources/js/system_settings/businessHours.js',
                    'resources/js/system_settings/modeofpayment.js', 
                    'resources/js/system_settings/guestpage/index.js',
                    'resources/js/system_settings/guestpage/edit.js',
                    'resources/js/user/appointment.js',
                    'resources/js/user/profilepage.js',
                ],
            refresh: true,
        }),
    ],
});
