const mix = require("laravel-mix")

mix.js(['./resources/assets/admin/js/home/app.js'], 'public/assets/admin/js/home/app.js').version();

mix.sass('./resources/assets/admin/sass/home/app.scss', 'public/assets/admin/css/home/app.css');
