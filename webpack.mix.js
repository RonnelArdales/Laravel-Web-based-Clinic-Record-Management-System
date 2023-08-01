// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/css/app.css', 
//                     'resources/js/app.js',
//                     'resources/js/secretary/user.js',
//                     'resources/js/secretary/user.js'
//                 ],
//             refresh: true,
//         }),
//     ],
// });


const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/user.js', 'public/js/admin')
    .js('resources/js/admin/document.js', 'public/js/admin')
    .js('resources/js/admin/consultation/create.js', 'public/js/admin/consultation')
    .js('resources/js/admin/consultation/index.js', 'public/js/admin/consultation')
    .js('resources/js/admin/consultation/view.js', 'public/js/admin/consultation')
    .js('resources/js/secretary/user.js', 'public/js/secretary')
    .js('resources/js/admin_secretary/pending.js', 'public/js/admin_secretary')
    .js('resources/js/admin_secretary/appointment.js', 'public/js/admin_secretary')
    .js('resources/js/admin_secretary/queuing.js', 'public/js/admin_secretary')
    .js('resources/js/admin_secretary/transaction.js', 'public/js/admin_secretary')
    .js('resources/js/admin_secretary/billing.js', 'public/js/admin_secretary')
    .js('resources/js/system_settings/service.js', 'public/js/system_settings')
    .js('resources/js/system_settings/discount.js', 'public/js/system_settings')
    .js('resources/js/system_settings/businessHours.js', 'public/js/system_settings')
    .js('resources/js/system_settings/modeofpayment.js', 'public/js/system_settings')
    .js('resources/js/system_settings/guestpage/index.js', 'public/js/system_settings/guestpage')
    .js('resources/js/system_settings/guestpage/edit.js', 'public/js/system_settings/guestpage')
    .postCss('resources/css/app.css', 'public/css');