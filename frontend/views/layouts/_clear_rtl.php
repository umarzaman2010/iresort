<?php
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */

//\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>"/>
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <meta name="generator" content="Mobirise v4.10.5, mobirise.com">-->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
<!--    <link rel="shortcut icon" href="assets/images/logo1-128x125.png" type="image/x-icon"-->
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php echo Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?php echo $content ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
