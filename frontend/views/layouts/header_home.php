<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
?>
<div id="top"></div>
<header class="s-header">
    <div class="row">
        <div class="col col-lg-2"></div>
        <div class="col col-lg-8" style="text-align: right; font-size: 22px;font-weight: bold">
            <?php if (Yii::$app->session->hasFlash('alert')):?>
                <?php echo \yii\bootstrap\Alert::widget([
                    'body'=>\yii\helpers\ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                    'options'=>\yii\helpers\ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
                ])?>
            <?php endif; ?>

        </div>
        <div class="col col-lg-2"></div>
    </div>
    <div class="header-logo">
        <a class="site-logo" href="<?php echo \yii\helpers\Url::to(Yii::getAlias('@web')) ?>">
            <!--                --><?//= \yii\helpers\Html::a('Home', ['/#home']) ?>

            <img src="<?= Yii::getAlias('@web')?>/glimages/services_images/small-white-logo-1316x1047.png" alt="Homepage">
        </a>
    </div>

    <nav class="header-nav">

        <a href="#0" class="header-nav__close" title="close"><span>Close</span></a>

        <div class="header-nav__content">
            <h3><?= Yii::t('frontend','Navigation') ?></h3>

                    <ul class="header-nav__list">
<!--                <li class="current"><a class="smoothscroll"  href="#home" title="home">Home</a></li>-->
                        <li><?= \yii\helpers\Html::a(Yii::t('frontend','Home'), ['/#home']) ?></li>

<!--                        <li><a class="smoothscroll"  href="#about" title="about">About</a></li>-->
                        <li><?= \yii\helpers\Html::a(Yii::t('frontend','About'), ['/#about']) ?></li>

<!--                        <li><a class="smoothscroll"  href="#services" title="services">Services</a></li>-->
                        <li><?= \yii\helpers\Html::a(Yii::t('frontend','Services'), ['/#services']) ?></li>
                        <li><?= \yii\helpers\Html::a(Yii::t('frontend','Terms and Condition'), ['/user/sign-in/terms']) ?></li>

                        <?php if(Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a(Yii::t('frontend','Register'), ['/user/sign-in/signup'], ['data' => ['method' => 'post']]) ?></li><?php }?>
                <?php if(Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a(Yii::t('frontend','Login'), ['/user/sign-in/login'], ['data' => ['method' => 'post']]) ?></li><?php }?>
                <?php if(!Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a('Logout', ['/user/sign-in/logout'], ['data' => ['method' => 'post']]) ?>

                </li><?php }?>

<hr style="line-height: 10px; outline-color: #ffffff">
                        <?php
array_map(function($code){
                              ?>
    <li><?= \yii\helpers\Html::a( Yii::$app->params['availableLocales'][$code], ['/site/set-locale', 'locale'=>$code]) ?></li>


    <?php
                            }, array_keys(Yii::$app->params['availableLocales']))
?>
            </ul>



        </div> <!-- end header-nav__content -->

    </nav>  <!-- end header-nav -->

    <a class="header-menu-toggle" href="#0">
        <span class="header-menu-text" style="font-size: 22px;font-weight: bold"><?= Yii::t('frontend', 'Menu') ?></span>
        <span class="header-menu-icon"></span>
    </a>

</header> <!-- end s-header -->
<!-- home
================================================== -->
<section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/hero-bg.jpg" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

    <div class="overlay"></div>
    <div class="shadow-overlay"></div>

    <div class="home-content" style="background-image:url('<?= Yii::getAlias('@web') ?>/glimages/services_images/IMG_20190930242555_428462833_huge.jpg');background-size: cover">


            <div class="row home-content__main" style="padding:24px;background-color: #000000;opacity: 0.3">

                <h2 class="mbr-fonts-style display-1" style="color: #ffffff"><?= Yii::t('frontend','New Concept In the world of Equestrian and Entertainment') ?></h2>


        </div>


        <div class="home-content__scroll">
            <a href="#about" class="scroll-link smoothscroll">
                <span>Scroll Down</span>
            </a>
        </div>

        <div class="home-content__line"></div>

    </div> <!-- end home-content -->


    <ul class="home-social">
        <li>
            <a href="#0"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
        </li>
        <li>
            <a href="#0"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twiiter</span></a>
        </li>
        <li>
            <a href="#0"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
        </li>

    </ul>
    <!-- end home-social -->

</section> <!-- end s-home -->
<!-- about
================================================== -->
