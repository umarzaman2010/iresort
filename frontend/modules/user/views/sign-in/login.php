<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\LoginForm */

$this->title = Yii::t('frontend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>



<section id='about' class="s-about" style="background: #000000">
    <div class="overlay"></div>
    <div class="row section-header has-bottom-sep" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead subhead--dark" style="color: #ffffff;">Enter your credentials to login
            </h3>
            <h1 class="display-1 display-1--light">Login</h1>
        </div>
    </div> <!-- end section-header -->

    <div class="row about-desc" data-aos="fade-up" >
        <div class="col-full">
            <div class="row contact-content" data-aos="fade-up">

                <div class="contact-primary2">
<!---->
<!--                    <div class="row">-->
<!--                        <div class="col-lg-5">-->
                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                            <?php echo $form->field($model, 'identity') ?>
                            <?php echo $form->field($model, 'password')->passwordInput() ?>
                            <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
                            <div style="color:#999;margin:1em 0">
                                <?php echo Yii::t('frontend', 'If you forgot your password you can reset it <a href="{link}">here</a>', [
                                    'link'=>yii\helpers\Url::to(['sign-in/request-password-reset'])
                                ]) ?>
                            </div>
                            <div class="form-group">
                                <?php echo Html::submitButton(Yii::t('frontend', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>
                     
                            <?php ActiveForm::end(); ?>
<!--                        </div>-->
<!--                    </div>-->

                    <!-- contact-warning -->
                    <div class="message-warning">
                        Something went wrong. Please try again.
                    </div>

                    <!-- contact-success -->
                    <div class="message-success">
                        Your message was sent, thank you!<br>
                    </div>

                </div> <!-- end contact-primary -->


            </div> <!-- end contact-content -->

        </div>
    </div> <!-- end about-desc -->


    <div class="about__line"></div>

</section> <!-- end s-about -->


