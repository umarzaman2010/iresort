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

<?=$this->render('@app/views/layouts/header2.php') ?>

<!--<!-- Breadcrumbs End -->
<!--<div class="container">-->
<?=$content; ?>
<!--</div>-->

<?=$this->render('@app/views/layouts/footer2.php') ?>

<?php $this->endContent(); ?>


