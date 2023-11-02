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

    //  ADMINISTRATION

        



        mix.styles([
                    'resources/adminlte3/plugins/fontawesome-free/css/all.css',
                    //'resources/adminlte3/plugins/fontawesome-free/css/all.min.css',

                    'resources/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                    'resources/adminlte3/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
                    'resources/adminlte3/plugins/jqvmap/jqvmap.min.css',
                    'resources/adminlte3/dist/css/adminlte.min.css',
                    'resources/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
                    'resources/adminlte3/plugins/daterangepicker/daterangepicker.css',
                    'resources/adminlte3/plugins/summernote/summernote-bs4.min.css',
        ], 'public/css/administration/administration_all.css')
        /*
            En:
                'resources/adminlte3/dist/css/adminlte.min.css' se modificó content:"Browse" por content:"Examinar"*/



        // ESTILOS PARA DATATABLES
        mix.styles([
            'resources/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
            'resources/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
            'resources/adminlte3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css',
        ], 'public/css/administration/datatables.css')


        //  ESTILOS IZITOAST
        mix.styles([
            'resources/iziToast/dist/css/iziToast.css'
        ], 'public/css/iziToast/iziToast.css')


        .scripts([
            'resources/adminlte3/plugins/jquery/jquery.min.js',
            'resources/adminlte3/plugins/jquery-ui/jquery-ui.min.js',
            'resources/adminlte3/plugins/resolve_conflict_in_jQuery_UI_tooltip_with_Bootstrap_tooltip.js',
            'resources/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js',        
            'resources/adminlte3/plugins/chart.js/Chart.min.js',
            'resources/adminlte3/plugins/sparklines/sparkline.js',
            'resources/adminlte3/plugins/jqvmap/jquery.vmap.min.js',
            'resources/adminlte3/plugins/jqvmap/maps/jquery.vmap.usa.js',
            'resources/adminlte3/plugins/jquery-knob/jquery.knob.min.js',
            'resources/adminlte3/plugins/moment/moment.min.js',
            'resources/adminlte3/plugins/daterangepicker/daterangepicker.js',
            'resources/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
            'resources/adminlte3/plugins/summernote/summernote-bs4.min.js',
            'resources/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'resources/adminlte3/dist/js/adminlte.js',
            'resources/adminlte3/dist/js/demo.js',
            //'resources/adminlte3/dist/js/pages/dashboard.js', //  incluir este archivo implica obtener errores por líneas de código en jquery.vmap.min.js
        ], 'public/js/administration/administration_all.js')


        // JS PARA DATATALES
        .scripts([
                'resources/adminlte3/plugins/jquery/jquery.min.js',
                'resources/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js',

                'resources/adminlte3/plugins/datatables/jquery.dataTables.min.js',        
                'resources/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                'resources/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js',
                'resources/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                'resources/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                'resources/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js',
                'resources/adminlte3/plugins/jszip/jszip.min.js',
                'resources/adminlte3/plugins/pdfmake/pdfmake.min.js',
                'resources/adminlte3/plugins/pdfmake/vfs_fonts.js',
                'resources/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js',
                'resources/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js',
                'resources/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js',
                
                'resources/adminlte3/dist/js/adminlte.js',
                'resources/adminlte3/dist/js/demo.js',
                //'resources/adminlte3/dist/js/pages/dashboard.js', //  incluir este archivo implica obtener errores por líneas de código en jquery.vmap.min.js
        ], 'public/js/administration/datatables.js')
        
        
        // JS PARA IZITOAST
        .scripts([
            'resources/iziToast/dist/js/iziToast.js'
        ], 'public/js/iziToast/iziToast.js');







    //  ECOMMERCE
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

