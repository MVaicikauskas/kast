let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


// let imageminPlugin = require('imagemin-webpack-plugin').default;
// let imageminMozjpeg = require('imagemin-mozjpeg');
// let copyWebpackPlugin = require('copy-webpack-plugin');

mix.setPublicPath('public_html');


// mix.webpackConfig( {
//         plugins: [
//             new copyWebpackPlugin([{
//                 from: 'resources/assets/images',
//                 to: 'dist/images',
//             }]), 
//             new imageminPlugin( {
//                 test: /.*\.(jpe?g|png|gif|svg)$/i,
//                 pngquant: {
//                     quality: '65-80',
//                 },
//                 plugins: [
//                     imageminMozjpeg({
//                         quality: 65,
//                         maxmemory: 1000 * 512
//                     })
//                 ]
//             } ),
//         ],
// });

mix.browserSync({ 
  // proxy: 'http://klaipedaasutavim.local/',
  // online: true,
  // tunnel: 'kast',
  files: [
    'public_html/dist/css/**/*.css',
    'public_html/dist/js/**/*.js',
    'resources/views/**/*.php',
    'app/Http/Controllers/**/*.php',
    'app/Http/Models/**/*.php',
    'routes/web.php'
  ]
});

mix.js('resources/assets/js/custom.min.js', 'dist/js');

mix.sass('resources/assets/sass/main.scss', 'dist/css')
    .options({
      processCssUrls: false
    })
    .sass('resources/assets/sass/admin/admin.scss', 'dist/css')
    .options({
      processCssUrls: false
    });


// mix.scripts([
//     'public_html/assets/js/jquery-3.2.1.min.js',
//     'public_html/assets/js/app.js'
//   ], 'public_html/assets/js/app.min.js');

// mix.styles([
//     'public_html/assets/css/preloader.css',
//     'public_html/assets/css/master.css'
//   ], 'public_html/assets/css/master.min.css');