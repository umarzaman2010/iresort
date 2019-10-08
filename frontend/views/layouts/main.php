<?php
/**
 * Created by PhpStorm.
 * User: UMER ZAMAN
 * Date: 12/09/2019
 * Time: 10:39
 */
/* @var $this \yii\web\View */
use yii\helpers\Url;
//use frontend\assets\TravelerAsset;
use yii\widgets\Breadcrumbs;
use yii\helpers\Json;
use frontend\assets\FrontendResortAsset;
use frontend\assets\GlintAsset;

//TravelerAsset::register($this);
//FrontendResortAsset::register($this);
GlintAsset::register($this);



?>

<?php $this->beginContent('@app/views/layouts/_clear.php'); ?>

<?=$this->render('@app/views/layouts/header_home.php') ?>

<!--<!-- Breadcrumbs End -->
<!--<div class="container">-->

<?php if (Yii::$app->session->hasFlash('alert')):?>
<?php echo \yii\bootstrap\Alert::widget([
    'body'=>\yii\helpers\ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
    'options'=>\yii\helpers\ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
])?>
<?php endif; ?>
    <?=$content; ?>
<!--</div>-->

<?=$this->render('@app/views/layouts/footer2.php') ?>

<?php $this->endContent(); ?>


