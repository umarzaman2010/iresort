<?php

namespace backend\controllers;

use backend\models\PasswordResetRequestForm;
use backend\models\search\UserSearch;
use backend\models\UserForm;
use common\models\SMS;
use common\models\SMSApproval;
use common\models\User;
use common\models\UserProfile;
use common\models\UserToken;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws \yii\base\Exception
     * @throws NotFoundHttpException
     */
    public function actionLogin($id)
    {
        $model = $this->findModel($id);
        $tokenModel = UserToken::create(
            $model->getId(),
            UserToken::TYPE_LOGIN_PASS,
            60
        );

        return $this->redirect(
            Yii::$app->urlManagerFrontend->createAbsoluteUrl(['user/sign-in/login-by-pass', 'token' => $tokenModel->token])
        );
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
        $model->setScenario('create');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = new UserForm();
        $model->setModel($this->findModel($id));
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'roles' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'name')
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        Yii::$app->authManager->revokeAll($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    /**
     * @return string|Response
     */
    public function actionAccept($id)
    {
        $user= User::findOne($id);
        $userProfile= UserProfile::findOne($user->id);
//        echo '<PRE>';
//        print_r($userProfile);exit;
        
        $model = new PasswordResetRequestForm();
        $model->email   =   $user->email;
//                echo '<PRE>';
//        print_r($model);exit;

        if($user->request_status   !=   2){
            $user->request_status   =   2;
            if ($model && $user->save()) {

//                $randOtp=rand(1000,9999).rand(11000,999999);
//                $regMessage =   'مبروك لقد تم اختياركم لتوقيع العقد الالكتروني للانضمام الى منتجع الفروسيه العالمي.
//الرجاء اتباع الرابط اناه   ';
//
//                $regMessage .= 'ieresort.com/ieresort/frontend/web/user/sign-in/terms?token='.$randOtp;
//
////                $regMessage .=  'http://'.$_SERVER['SERVER_NAME'].'/'.Yii::getAlias('frontend/web//user/sign-in/terms?token='.$randOtp);
//                $model->sendOTP($randOtp);
//                $ext    =   '+966';
//                $contact    =   $ext;
//                $contact    .=  stripslashes($userProfile->contact_number);
////                $contact    = '+966555895242';
////echo $contact;exit;
//
//                $sms    = new SMSApproval($contact,$regMessage);
//                print_r($sms);exit;
                if ($model->sendEmail()) {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t('frontend', 'Request Accepted Successfully.'),
                        'options' => ['class' => 'alert-success']
                    ]);

                    return $this->redirect(['index']);
                } else {
                    Yii::$app->getSession()->setFlash('alert', [
                        'body' => Yii::t('frontend', 'Sorry, SMS has not been sent. Verifiy customer contact.'),
                        'options' => ['class' => 'alert-danger']
                    ]);
                }
            }

            return $this->render('acceptClientRequestToken', [
                'model' => $model,
            ]);
        }

    }

}
