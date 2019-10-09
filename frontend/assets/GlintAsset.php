<?php

namespace frontend\assets;

use yii\web\AssetBundle;

use yii\bootstrap\BootstrapAsset;
//use yii\web\AssetBundle;
use yii\web\YiiAsset;
/**
 * Main frontend application asset bundle.
 */
class GlintAsset extends AssetBundle
{



    /**
     * @var string
     */
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@bower/glint/';

    /**
     * @var array
     */
    public $css = [
        'css/base.css',
        'css/vendor.css',
        'css/main.css',
        'css/mbr-additional.css',
        'slider/style.css',
        'css/bootstrap-grid.min.css',
        'css/font-awesome/fonts/fontawesome-webfont.woff',
        'css/font-awesome/fonts/fontawesome-webfont.woff2',
//        'css/bootstrap-grid.min.css',
//        'css/magnific-popup.css',
//        'css/bootstrap-datepicker.min.css',
//        'css/owl.carousel.min.css',
//        'css/owl.theme.default.min.css',
//        'css/style.css',
//        'theme/css/style.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/modernizr.js',
        'js/pace.min.js',
        'js/jquery-3.2.1.min.js',
        'js/plugins.js',
        'js/main.js',
//        'js/jquery.waypoints.min.js',
//        'js/owl.carousel.min.js',
//        'js/jquery.countTo.js',
//        'js/jquery.stellar.min.js',
//        'js/jquery.magnific-popup.min.js',
//        'js/magnific-popup-options.js',
//        'js/bootstrap-datepicker.min.js',
        'js/main.js',
//        'theme/js/script.js',
//        'slidervideo/script.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
//        Html5shiv::class,
    ];

    public $cssOptions = ['position' => \yii\web\View::POS_HEAD];
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }



//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
//    public $css = [
//        'css/site.css',
//    ];
//    public $js = [
//    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
}
