<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\modules\user\models\SignupForm */


?>

<section id='about' class="s-about" style="background: #000000">

    <div class="row about-desc" data-aos="fade-up" >
        <div class="col-full">
            <div class="row contact-content" data-aos="fade-up">

                <div class="contact-primary2">

<!--                    <form name="contactForm" id="contactForm" method="post" action="" novalidate="novalidate">-->
                        <fieldset>
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Full Name
                                </p>
                                <?php echo $form->field($model, 'firstname')->textInput()->input('firstname', ['placeholder' => "Full Name"])->label(false); ?>
                            </div>

                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Mobile No
                                </p>
                                <?php echo $form->field($model, 'contact_number')->textInput()->input('contact_number', ['placeholder' => "+966550000000"])->label(false); ?>
                            </div>


                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Email
                                </p>
                                <?php echo $form->field($model, 'email')->textInput()->input('email1', ['placeholder' => "Email Address"])->label(false); ?>
                            </div>

                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Age Group
                                </p>
                                <span style="color:#0d0d0d">
                                <?php echo $form->field($model, 'age_group')->dropDownList(\frontend\modules\user\models\SignupForm::ageLimit())->label(false);; ?>
                                </span>
                            </div>

                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Choose your reason for subscription
                                </p>
                                <span style="align-content: flex-start">
                                                                    <?php echo $form->field($model, 'subscription_reason')->checkboxList(\frontend\modules\user\models\SignupForm::subscriptionReason())->label(false); ?>

                                </span>
                            </div>

                            <div class="form-field">
                                <p style="color: #ffffff; text-align: left; margin: 0px;padding: 0;">
                                    Important firgure you recommend
                                </p>
                                <?php echo $form->field($model, 'recommend_fig')->textarea(['rows' => '6'])->label(false); ?>
                            </div>

                            <div class="form-group">
                                <?php echo Html::submitButton(Yii::t('frontend', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
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


<!--    <div class="about__line"></div>-->

</section> <!-- end s-about -->
