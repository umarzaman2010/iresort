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
    <?php echo 'Hello, '; ?>
    <div class="body">
      <p>
          <?php echo 'New User ' .$userProfile->firstname.', has been registered in the system. See detail below'?></p>
        <body style="margin: 0; padding: 0;">
        <table border="1" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    Full Name
                </td>
                <td>
                    <?php echo $userProfile->firstname; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Mobile No
                </td>
                <td>
                    <?php echo $userProfile->contact_number; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo $user->email; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Age Group
                </td>
                <td>
                    <?php echo $userProfile->age_group;  ?>
                </td>
            </tr>

            <tr>
                <td>
                    Choose your reason for subscription
                </td>
                <td>
                    <?php echo $userProfile->subscription_reason; ?>
                </td>
            </tr>

            <tr>
                <td>
                    Important firgure you recommend
                </td>
                <td>
                    <?php echo $userProfile->recommend_fig; ?>
                </td>
            </tr>
        </table>
        </body>
      
      
        <br>
    </div>
    <div class="footer">With kind regards,Iresort team</div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>