const mix = require("laravel-mix")

// const appPublicPath = global.process.env.MIX_PUBLIC_PATH || 'public';

// mix.setPublicPath(`${appPublicPath}/assets/admin/js/home/`);

mix.js(['./resources/assets/admin/js/home/app.js'], 'public/assets/admin/js/home/app.js').version();

mix.sass('./resources/assets/admin/sass/home/app.scss', 'public/assets/admin/css/home/app.css');
