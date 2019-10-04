<?php

namespace backend\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserToken;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    /**
     * @var user email
     */
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_CLIENT_REQUEST_ACCEPT, Time::SECONDS_IN_A_DAY);
            if ($user->save()) {
                return Yii::$app->commandBus->handle(new SendEmailCommand([
                    'to' => $this->email,
                    'subject' => Yii::t('backend', 'Request approved from {name}', ['name' => Yii::$app->name]),
                    'view' => 'main',
                    'params' => [
                        'user' => $user,
                        'token' => $token->token
                    ]
                ]));
            }
        }

        return false;
    }



    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendOTP($otp)
    {

        $randOTP    =   $otp;
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
//            $token = UserToken::create($user->id, UserToken::TYPE_CLIENT_REQUEST_ACCEPT, Time::SECONDS_IN_A_DAY);

            $token = UserToken::createOTP($randOTP,$user->id, UserToken::TYPE_CLIENT_REQUEST_ACCEPT, Time::SECONDS_IN_A_DAY);
            if ($user->save()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('frontend', 'E-mail')
        ];
    }
}
