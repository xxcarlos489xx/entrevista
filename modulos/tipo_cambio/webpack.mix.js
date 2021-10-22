const mix = require("laravel-mix")

mix.js(['./resources/assets/admin/js/tipo_cambio/index.js'], 'public/assets/admin/js/tipo_cambio/index.js').version();

mix.js(['./resources/assets/admin/js/tipo_cambio/add.js'], 'public/assets/admin/js/tipo_cambio/add.js').version();

mix.js(['./resources/assets/admin/js/tipo_cambio/edit.js'], 'public/assets/admin/js/tipo_cambio/edit.js').version();

mix.sass('./resources/assets/admin/sass/tipo_cambio/app.scss', 'public/assets/admin/css/tipo_cambio/app.css');
