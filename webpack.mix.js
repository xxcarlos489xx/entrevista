// const mix = require('laravel-mix');

// mix.options({
//     hmrOptions: {
//         host: 'localhost',
//         port: '8002'
//     }
// })
const {MIX_PACKAGE, NPM, VENDOR, OUTPUT, output} = require('laravel-multimix');

let folder = MIX_PACKAGE
const modulesPath = `${__dirname}/modulos/`;
require(`${modulesPath}/${folder}/webpack.mix.js`);
