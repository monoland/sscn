const mix = require('laravel-mix');

// mix.options({
//     processCssUrls: false
// });

mix.js('resources/scripts/main.js', 'public/kominfo/script')
   .stylus('resources/stylus/main.styl', 'public/kominfo/style');

mix.extract(['axios', 'chart.js', 'lodash', 'shortid', 'vue', 'vuetify', 'vue-router']);