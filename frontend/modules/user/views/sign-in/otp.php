<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */


?>

<section id='about' class="s-about" style="background: #000000">
    <div class="row section-header has-bottom-sep" data-aos="fade-up">
        <div class="col-full">
            <h3 class="subhead subhead--dark" style="color: #ffffff;">Enter verification code, you will receive on your mobile number.
            </h3>
        </div>
    </div> <!-- end section-header -->

    <div class="row about-desc" data-aos="fade-up" >
        <div class="col-full">
            <div class="row contact-content" data-aos="fade-up">

                <div class="contact-primary2">

<!--                    <form name="contactForm" id="contactForm" method="post" action="" novalidate="novalidate">-->
                        <fieldset>
                            <?php $form = ActiveForm::begin(['id' => 'form-otp']); ?>


                                    <div class="form-field">
                                        <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                           Enter code you recieved
                                        </p>
                                        <?php echo $form->field($model, 'otp_token')->textInput()->input('token', ['placeholder' => "Enter verification code"])->label(false); ?>
                                    </div>

                            <div class="form-group">
                                <?php echo Html::submitButton(Yii::t('frontend', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </fieldset>
<!--                            <div class="form-field">-->
<!--                                <input name="contactEmail" type="email" id="contactEmail" placeholder="Your Email" value="" required="" aria-required="true" class="full-width">-->
<!--                            </div>-->
<!--                            <div class="form-field">-->
<!--                                <input name="contactSubject" type="text" id="contactSubject" placeholder="Subject" value="" class="full-width">-->
<!--                            </div>-->
<!--                            <div class="form-field">-->
<!--                                <textarea name="contactMessage" id="contactMessage" placeholder="Your Message" rows="10" cols="50" required="" aria-required="true" class="full-width"></textarea>-->
<!--                            </div>-->
<!--                            <div class="form-field">-->
<!--                                <button class="full-width btn--primary">Submit</button>-->
<!--                                <div class="submit-loader">-->
<!--                                    <div class="text-loader">Sending...</div>-->
<!--                                    <div class="s-loader">-->
<!--                                        <div class="bounce1"></div>-->
<!--                                        <div class="bounce2"></div>-->
<!--                                        <div class="bounce3"></div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->


<!--                    </form>-->

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
