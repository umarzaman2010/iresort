<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
?>
<!-- Main content -->
<section class="content">
    <?php if (Yii::$app->session->hasFlash('alert')): ?>
        <?php echo Alert::widget([
            'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
            'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
        ]) ?>
    <?php endif; ?>
</section><!-- /.content -->
<header class="s-header">
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

    <a class="header-menu-toggle" href="#0">
        <span class="header-menu-text">Menu</span>
        <span class="header-menu-icon"></span>
    </a>

</header> <!-- end s-header -->
<!-- home
================================================== -->
<section id="home" class="s-home target-section" data-parallax="scroll" data-image-src="images/hero-bg.jpg" data-natural-width=3000 data-natural-height=2000 data-position-y=center>

    <div class="overlay"></div>
    <div class="shadow-overlay"></div>

    <div class="home-content" style="background-image:url('<?= Yii::getAlias('@web') ?>/glimages/services_images/1-1920x1080.jpg');background-size: cover">

        <div class="row home-content__main">

            <h2 class="mbr-fonts-style display-1">True Outdoor Landscape</h2>
            <h2 class="br-fonts-style display-1">a huge area of landscape of green areas and basketball/tennis play yards and special lane for horse riding/walking/ byscle</h2>

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
