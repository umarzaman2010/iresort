<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
<!--    <style type="text/css">
        .heading {...}
        .list {...}
        .footer {...}
    </style>-->
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <?php echo 'Hello '.$user->username.','; ?>
    <div class="body">
      
        <p>Click the following URL to accept terms and condition. This URL will be redirect to Iresort Application.</p>
<!--        <p>Username:--><?php //echo $user->username; ?><!--</p>-->
<!--        <p>URL: --><?php //echo  $url = $_SERVER['SERVER_NAME'] . '/' . Yii::getAlias('frontend/web//user/sign-in/terms?token='.$token); ?><!--</p>-->
        <br>
    </div>
    <div class="footer">With kind regards,Iresort team</div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>