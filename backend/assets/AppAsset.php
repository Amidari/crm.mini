<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //AdminLTE
        'css/adminlte/fontawesome-free/css/all.css',
        'css/adminlte/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'css/adminlte/icheck-bootstrap/icheck-bootstrap.min.css',
        'css/adminlte/jqvmap/jqvmap.min.css',
        'css/adminlte/adminlte.min.css',
        'css/adminlte/overlayScrollbars/css/OverlayScrollbars.min.css',
        'css/adminlte/daterangepicker/daterangepicker.css',
        'css/adminlte/summernote/summernote-bs4.min.css',
    ];
    public $js = [
        //AdminLTE
        'js/adminlte/jquery/jquery.min.js',
        'js/adminlte/jquery-ui/jquery-ui.min.js',
        'js/adminlte/bootstrap/js/bootstrap.bundle.min.js',
        'js/adminlte/chart.js/Chart.min.js',
        'js/adminlte/sparklines/sparkline.js',
        'js/adminlte/jqvmap/jquery.vmap.min.js',
        'js/adminlte/jqvmap/maps/jquery.vmap.usa.js',
        'js/adminlte/jquery-knob/jquery.knob.min.js',
        'js/adminlte/moment/moment.min.js',
        'js/adminlte/daterangepicker/daterangepicker.js',
        'js/adminlte/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'js/adminlte/summernote/summernote-bs4.min.js',
        'js/adminlte/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'js/adminlte/adminlte.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset',
    ];
}
