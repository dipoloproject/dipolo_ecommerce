const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);


//  COMPILACION: CSS y JS
mix.styles([
            // 'resources/css/fontawesome.releases.v5.0.1.css.all.css',
            'resources/css/material-design-iconic-font.min.css',
            'resources/css/font-awesome.min.css',            
            'resources/css/fontawesome-stars.css',
            'resources/css/meanmenu.css',
            'resources/css/owl.carousel.min.css',
            'resources/css/slick.css',
            'resources/css/animate.css',
            'resources/css/jquery-ui.min.css',
            'resources/css/venobox.css',
            'resources/css/nice-select.css',
            'resources/css/magnific-popup.css',
            'resources/css/bootstrap.min.css',
            'resources/css/helper.css',
            'resources/css/style.css',
            'resources/css/responsive.css',
            'resources/css/gap_styles.css',
            
], 'public/css/all.css')



.scripts([
            'resources/js/vendor/modernizr-2.8.3.min.js',
            'resources/js/vendor/jquery-1.12.4.min.js',        
            'resources/js/vendor/popper.min.js',        
            'resources/js/bootstrap.min.js',
            'resources/js/ajax-mail.js',
            'resources/js/jquery.meanmenu.min.js',
            'resources/js/wow.min.js',
            'resources/js/slick.min.js',
            'resources/js/owl.carousel.min.js',
            'resources/js/jquery.magnific-popup.min.js',
            'resources/js/isotope.pkgd.min.js',
            'resources/js/imagesloaded.pkgd.min.js',
            'resources/js/jquery.mixitup.min.js',
            'resources/js/jquery.countdown.min.js',
            'resources/js/jquery.counterup.min.js',
            'resources/js/waypoints.min.js',
            'resources/js/jquery.barrating.min.js',
            'resources/js/jquery-ui.min.js',
            'resources/js/venobox.min.js',
            'resources/js/jquery.nice-select.min.js',
            'resources/js/scrollUp.min.js',
            'resources/js/main.js',

], 'public/js/all.js');
//

