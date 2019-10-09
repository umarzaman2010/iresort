<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
?>
<div id="top"></div>
<header class="s-header">
    <!-- Main content -->
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
            <h3>Navigation</h3>

                    <ul class="header-nav__list">
<!--                <li class="current"><a class="smoothscroll"  href="#home" title="home">Home</a></li>-->
                        <li><?= \yii\helpers\Html::a('Home', ['/#home']) ?></li>

<!--                        <li><a class="smoothscroll"  href="#about" title="about">About</a></li>-->
                        <li><?= \yii\helpers\Html::a('About', ['/#about']) ?></li>

<!--                        <li><a class="smoothscroll"  href="#services" title="services">Services</a></li>-->
                        <li><?= \yii\helpers\Html::a('services', ['/#services']) ?></li>
                        <li><?= \yii\helpers\Html::a('Terms and Condition', ['/user/sign-in/terms']) ?></li>

                        <?php if(Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a('Register', ['/user/sign-in/signup'], ['data' => ['method' => 'post']]) ?></li><?php }?>
                <?php if(Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a('Login', ['/user/sign-in/login'], ['data' => ['method' => 'post']]) ?></li><?php }?>
                <?php if(!Yii::$app->user->isGuest){?> <li><?= \yii\helpers\Html::a('Logout', ['/user/sign-in/logout'], ['data' => ['method' => 'post']]) ?>

                </li><?php }?>

<hr style="line-height: 10px; outline-color: #ffffff">
                        <?php
array_map(function($code){
                              ?>
    <li><?= \yii\helpers\Html::a(Yii::t('frontend',Yii::$app->params['availableLocales'][$code]), ['/site/set-locale', 'locale'=>$code]) ?></li>


    <?php
                            }, array_keys(Yii::$app->params['availableLocales']))
?>
            </ul>



        </div> <!-- end header-nav__content -->

    </nav>  <!-- end header-nav -->

    <a class="header-menu-toggle" href="#0" >
        <span class="header-menu-text" style="font-size: 22px;font-weight: bold">Menu</span>
        <span class="header-menu-icon"></span>
    </a>

</header> <!-- end s-header -->
<!-- home
================================================== -->
<section id='about' class="s-about" style="background: #000000">
    <div class="row section-header has-bottom-sep" data-aos="fade-up">
        <div class="col-full">

            <h1 class="display-1 display-1--light">Verification Step</h1>
        </div>
    </div> <!-- end section-header -->

</section> <!-- end s-about -->