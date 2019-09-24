<?php
/**
 * Created by PhpStorm.
 * User: UMER ZAMAN
 * Date: 14/09/2019
 * Time: 14:49
 */
use frontend\themes\traveler\web\FrontendResortAsset;


/* @var $this \yii\web\View */ /* @var $content string */
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\helpers\Json;
FrontendResortAsset::register($this);

 $this->beginContent(''); ?>
<?=$this->render('@app/views/layouts/header.php') ?>
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <?=Breadcrumbs::widget( [ 'links'=> isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], 'options' => ['class' => 'breadcrumb'], ] ) ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <div class="container">
        <?=$content; ?>
    </div>
<?=$this->render('@app/views/layouts/footer.php') ?>
      <?php $this->endContent(); ?>