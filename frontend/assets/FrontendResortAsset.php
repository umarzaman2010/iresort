<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use common\assets\Html5shiv;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;
use yii\web\YiiAsset;

/**
 * Frontend application asset
 */
class FrontendResortAsset extends AssetBundle
{
    /**
     * @var string
     */
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';
    public $sourcePath = '@bower/iresorts/';

    /**
     * @var array
     */
    public $css = [
        'web/assets/mobirise-icons-bold/mobirise-icons-bold.css',
        'web/assets/mobirise-icons/mobirise-icons.css',
        'tether/tether.min.css',
        'bootstrap/css/bootstrap.min.css',
        'bootstrap/css/bootstrap-grid.min.css',
        'bootstrap/css/bootstrap-reboot.min.css',
        'dropdown/css/style.css',
        'animatecss/animate.min.css',
        'socicon/css/styles.css',
        'theme/css/style.css',
        'mobirise/css/mbr-additional.css',
//        'css/style.css',
//        'theme/css/style.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'web/assets/jquery/jquery.min.js',
        'popper/popper.min.js',
        'tether/tether.min.js',
        'bootstrap/js/bootstrap.min.js',
        'dropdown/js/nav-dropdown.js',
        'dropdown/js/navbar-dropdown.js',
        'touchswipe/jquery.touch-swipe.min.js',
        'ytplayer/jquery.mb.ytplayer.min.js',
        'vimeoplayer/jquery.mb.vimeo_player.js',
        'smoothscroll/smooth-scroll.js',
        'bootstrapcarouselswipe/bootstrap-carousel-swipe.js',
        'parallax/jarallax.min.js',
        'viewportchecker/jquery.viewportchecker.js',
        'theme/js/script.js',
        'slidervideo/script.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        Html5shiv::class,
    ];

    public $cssOptions = ['position' => \yii\web\View::POS_HEAD];
        /**
         * @inheritdoc
         */
        public function init() {
            parent::init();
        }
}
