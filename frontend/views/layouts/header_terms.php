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
<section class="header1 cid-ry2gdTFqOk" id="header16-1r">





    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-10 align-center">
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    TERS AND CONDITIONS&nbsp;</h1>

                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    fully detailed law terms and privacy policy and other conditions</p>

            </div>
        </div>
    </div>

</section>