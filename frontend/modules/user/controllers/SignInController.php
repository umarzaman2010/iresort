<?php

namespace frontend\modules\user\controllers;

use common\commands\SendEmailCommand;
use common\models\SMS;
use common\models\SMSApproval;
use common\models\User;
use common\models\UserProfile;
use common\models\UserToken;
use frontend\modules\user\models\LoginForm;
use frontend\modules\user\models\OTPConfirmForm;
use frontend\modules\user\models\PasswordResetRequestForm;
use frontend\modules\user\models\RequestAcceptdForm;
use frontend\modules\user\models\RequestAcceptForm;
use frontend\modules\user\models\ResetPasswordForm;
use frontend\modules\user\models\SignupForm;
use Yii;
use yii\authclient\AuthAction;
use yii\base\Exception;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class SignInController
 * @package frontend\modules\user\controllers
 * @author Eugene Terentev <eugene@terentev.net>
 */
class SignInController extends \yii\web\Controller
{

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'oauth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'successOAuthCallback']
            ]
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'signup', 'login', 'login-by-pass', 'request-password-reset', 'reset-password', 'oauth', 'activation','terms','otp'
                        ],
                        'allow' => true,
                        'roles' => ['?']
                    ],
                    [
                        'actions' => [
                            'signup', 'login', 'request-password-reset', 'reset-password', 'oauth', 'activation'
                        ],
                        'allow' => false,
                        'roles' => ['@'],
                        'denyCallback' => function () {
                            return Yii::$app->controller->redirect(['/user/default/index']);
                        }
                    ],
                    [
                        'actions' => ['logout','terms','otp'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post']
                ]
            ]
        ];
    }

    /**
     * @return array|string|Response
     */
    public function actionLogin()
    {
        $this->layout='../../../../views/layouts/main2';
        $model = new LoginForm();
        if (Yii::$app->request->isAjax) {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * @param $token
     * @return array|string|Response
     * @throws ForbiddenHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLoginByPass($token)
    {
        if (!$this->module->enableLoginByPass) {
            throw new NotFoundHttpException();
        }

        $user = UserToken::use($token, UserToken::TYPE_LOGIN_PASS);

        if ($user === null) {
            throw new ForbiddenHttpException();
        }

        Yii::$app->user->login($user);
        return $this->goHome();
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $this->layout='../../../../views/layouts/main3';
//        echo '<PRE>';
//        print_r(Yii::$app->request->post());exit;
        if ($model->load(Yii::$app->request->post())) {
            $mobileNo  =   Yii::$app->request->post('User')['contact_number'];
            $mobileNo  =  $model->contact_number;
            $email  =   Yii::$app->request->post('User')['email'];
            $user = $model->signup();
            if ($user) {
                if ($model->shouldBeActivated()) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'type' => 'success',
                        'duration' => 12000,
                        'icon' => 'fa fa-users',
                        'message' => Yii::t('frontend', 'Your account has been successfully created. Check your email for further instructions.'),
                        'title' => Yii::t('frontend', 'Success'),
                        'positonY' => 'top',
                        'positonX' => 'right'
//
//                        'body' => Yii::t(
//                            'frontend',
//                            'Your account has been successfully created. Check your email for further instructions.'
//                        ),
//                        'options' => ['class' => 'alert-success']
                    ]);
                }

$regMessage =   'شكرا لرغبتكم بعضويه منتجع الفروسيه العالمي،
سوف يقوم فريقنا بالتواصل معكم لاستكمال الاجراءت المطلوبه';
                        $contact    =   '+966594078099';

                    $contact    =   '+966'.stripslashes($mobileNo);
//                echo $contact;exit;
//                    $contact    =   '+966555895242';


        $sms    = new SMS($contact,$regMessage);
//        $sms->SendMessage();
        if($sms){
            $message=' اوافق على كل ما ورد اعلاه و بكل المواد الواردة';
            $message    .='بالنقر على الموافق سوف يتم استلام كود على رقمكم المسجل للتاكيد';
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t(
                    'frontend',
                    $message
                ),
                'options' => ['class' => 'alert-success']
            ]);
        }
                    $modelPasswordRequest = new PasswordResetRequestForm();

                    $modelPasswordRequest->email    =    $model->email;
                    if($modelPasswordRequest->sendAdminEmail()){
                    }

//exit;
// else {
//                    Yii::$app->getUser()->login($user);
//                }
              return  $this->redirect(['signup']);
                return $this->goHome();
            }
        }
//echo '<PRE>';
//        print_r($model);exit;
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    /**
     * @param $token
     * @return Response
     * @throws BadRequestHttpException
     */
    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            throw new BadRequestHttpException;
        }

        $user = $token->user;
        $user->updateAttributes([
            'status' => User::STATUS_ACTIVE
        ]);
        $token->delete();
        Yii::$app->getUser()->login($user);
        Yii::$app->getSession()->setFlash('alert', [
            'body' => Yii::t('frontend', 'Your account has been successfully activated.'),
            'options' => ['class' => 'alert-success']
        ]);

        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Check your email for further instructions.'),
                    'options' => ['class' => 'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Sorry, we are unable to reset password for email provided.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }


    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => Yii::t('frontend', 'New password was saved.'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * @param $client \yii\authclient\BaseClient
     * @return bool
     * @throws Exception
     */
    public function successOAuthCallback($client)
    {
        // use BaseClient::normalizeUserAttributeMap to provide consistency for user attribute`s names
        $attributes = $client->getUserAttributes();
        $user = User::find()->where([
            'oauth_client' => $client->getName(),
            'oauth_client_user_id' => ArrayHelper::getValue($attributes, 'id')
        ])->one();
        if (!$user) {
            $user = new User();
            $user->scenario = 'oauth_create';
            $user->username = ArrayHelper::getValue($attributes, 'login');
            // check default location of email, if not found as in google plus dig inside the array of emails
            $email = ArrayHelper::getValue($attributes, 'email');
            if($email === null){
                $email = ArrayHelper::getValue($attributes, ['emails', 0, 'value']);
            }
            $user->email = $email;
            $user->oauth_client = $client->getName();
            $user->oauth_client_user_id = ArrayHelper::getValue($attributes, 'id');
            $user->status = User::STATUS_ACTIVE;
            $password = Yii::$app->security->generateRandomString(8);
            $user->setPassword($password);
            if ($user->save()) {
                $profileData = [];
                if ($client->getName() === 'facebook') {
                    $profileData['firstname'] = ArrayHelper::getValue($attributes, 'first_name');
                    $profileData['lastname'] = ArrayHelper::getValue($attributes, 'last_name');
                }
                $user->afterSignup($profileData);
                $sentSuccess = Yii::$app->commandBus->handle(new SendEmailCommand([
                    'view' => 'oauth_welcome',
                    'params' => ['user' => $user, 'password' => $password],
                    'subject' => Yii::t('frontend', '{app-name} | Your login information', ['app-name' => Yii::$app->name]),
                    'to' => $user->email
                ]));
                if ($sentSuccess) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-success'],
                            'body' => Yii::t('frontend', 'Welcome to {app-name}. Email with your login information was sent to your email.', [
                                'app-name' => Yii::$app->name
                            ])
                        ]
                    );
                }

            } else {
                // We already have a user with this email. Do what you want in such case
                if ($user->email && User::find()->where(['email' => $user->email])->count()) {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-danger'],
                            'body' => Yii::t('frontend', 'We already have a user with email {email}', [
                                'email' => $user->email
                            ])
                        ]
                    );
                } else {
                    Yii::$app->session->setFlash(
                        'alert',
                        [
                            'options' => ['class' => 'alert-danger'],
                            'body' => Yii::t('frontend', 'Error while oauth process.')
                        ]
                    );
                }

            };
        }
        if (Yii::$app->user->login($user, 3600 * 24 * 30)) {
            return true;
        }

        throw new Exception('OAuth error');
    }


    public function actionTerms($token=''){

//        $contact    =   '+966594078099';
//        $sms    = new SMS($contact);
////        $sms->SendMessage();
//        if($sms){
//            echo 'message sent';exit;
//        }else{
//            echo 'message not';exit;
//        }
//exit;
$token2 =$token;

        $model  =   new User();
//        $token2='waJkxyzDgCLcT5Bp1MjIu6QAudOGdFBTOq1DjYyd';
        $this->layout='../../../../views/layouts/main2';
        $model->scenario    =   User::SCENARIO_Register_ACCEPT_TERMS;
        if (Yii::$app->request->post('User')) {

            $token    =   Yii::$app->request->post('User')['token'];
//            echo $token;exit;
            try {
                $modelRequest = new RequestAcceptForm($token);
//                $model->requestApprovalToken($token);
            } catch (InvalidArgumentException $e) {

                throw new BadRequestHttpException($e->getMessage());
            }

            $model  =   new User();
            $userToken  =    $modelRequest->token;

//            echo $userToken;exit;
            $modelUser= User::findIdentityByRequestAcceptToken($userToken);
            if(!$modelUser)
            {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Your registration session has expired please register again'),
                    'options' => ['class' => 'alert-danger']
                ]);
//                echo 'hai...terms';
                return $this->render('terms', [
                    'model' => $model,
                    'token' => $userToken
                ]);
            }
//
            $userProfile    =   UserProfile::findOne($modelUser->user_id);
//            print_r($userProfile);exit;
            $acceptTerms    =   Yii::$app->request->post('User')['accept_terms'];
            $model->accept_terms    =   $acceptTerms;
            $randOtp=rand(1000,9999);
            $regMessage =   'لرجاء ادخال الرقم للتاكيد
 token number: '.$randOtp;
            $contact    =   '+966594078099';
            $ext    =   '+966';
            $contact    =  $ext.$userProfile->contact_number;
            $sms    = new SMS($contact,$regMessage);
//        $sms->SendMessage();

//            if($acceptTerms !='' && $sms){
                $modelOTP = new PasswordResetRequestForm();

//                echo '<PRE>';
//                print_r($modelUser);exit;
                $userID   =    $modelUser->user_id;
                $userModel   =   User::findOne($userID);

            // save Opt AGAINST THIS EMAIL
                $modelOTP->email   =    $userModel->email;

                if($modelOTP->sendOTP($randOtp)){

                    $message=' اوافق على كل ما ورد اعلاه و بكل المواد الواردة';
                    $message    .='بالنقر على الموافق سوف يتم استلام كود على رقمكم المسجل للتاكيد';
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t(
                            'frontend',
                            $message
                        ),
                        'options' => ['class' => 'alert-success']
                    ]);

                return   $this->redirect(['otp']);
            } else {
//                    echo 'hai..';
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => Yii::t('frontend', 'Sorry, we are unable to send you verification code. Contact with Iresort team'),
                    'options' => ['class' => 'alert-danger']
                ]);
                    return $this->render('terms', [
                        'model' => $model,
                        'token' => $userToken
                    ]);
            }
//            }

//
//
//            $model->accept_terms    = $acceptTerms;
//            $model->save(false);
//            return $this->goBack();
        }
        return $this->render('terms', [
            'model' => $model,
            'token' => $token2
        ]);
    }


    public function actionOtp(){
$this->layout   = '../../../../views/layouts/main4';
        $model  =   new User();
        $model->scenario    =   User::SCENARIO_OTP_VERIFICATION;

//        print_r(Yii::$app->request->post('User'));exit;
if(Yii::$app->request->post('User')){

    $token  =   Yii::$app->request->post('User')['otp_token'];
//    $model->otp_token   =  $token;

    try {
        $modelOTPConfirm= new OTPConfirmForm($token);
//                $modelRequest->requestApprovalToken($token2);
    } catch (InvalidArgumentException $e) {
        throw new BadRequestHttpException($e->getMessage());
    }
//    echo $modelOTPConfirm->token;exit;
//print_r($modelOTPConfirm);exit;
//        $modelUser= User::findIdentityByRequestAcceptToken($modelOTPConfirm->token);
        $modelUser= User::findIdentityByOTPToken($modelOTPConfirm->token);
       if($modelUser){
       $model->accept_terms=1;
    $model->save();
           $userProfile    =   UserProfile::findOne($modelUser->user_id);
           $regMessage =   'تم انضمامكم رسميا لعضويه منتجع الفروسيه العالمي و سوف يتم التواصل معكم لاستكمال اجراءات السداد ';
           $contact    =   '+966594078099';
           $ext    =   '+966';
           $contact    =  $ext.$userProfile->contact_number;
           $sms    = new SMSApproval($contact,$regMessage);

           $message='لقد تم توقيع العقد الكترونيا و حسب الانظمه السعودية، سوف يتم التواصل معكم من قسم خدمات الاعضاء لاستكمال عملية سداد الرسوم.';
           Yii::$app->getSession()->setFlash('alert', [
               'body' => Yii::t(
                   'frontend',
                   $message
               ),
               'options' => ['class' => 'alert-success']
           ]);

           $this->redirect(['terms']);

//           echo 'hai.sss.';exit;
    }
//    echo 'hai..';exit;
}
//        echo 'hai....';exit;
    return    $this->render('otp',[
            'model'=>$model,
//            'token'=>$token

        ]);

    }



}
