<?php

namespace frontend\modules\user\models;

use common\models\UserToken;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Password reset form
 */
class OTPConfirmForm extends Model
{
    /**
     * @var
     */
    public $password;

    /**
     * @var \common\models\UserToken
     */
    public $token;

    /**
     * Creates a form model given a token.
     *
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Verification Code cannot be blank.');
        }
        /** @var UserToken $tokenModel */
        $this->token = UserToken::find()
            ->notExpired()
            ->byType(UserToken::TYPE_OTP)
            ->byToken($token)
            ->one();

        if (!$this->token) {
            throw new InvalidArgumentException('Verification token invalide or expired, Please contact Iresort');
        }
        parent::__construct($config);
    }

/*
     * @param  string $token
     * @param  array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidArgumentException if token is empty or not valid
     */
    public  function requestApprovalToken($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Request approval token cannot be blank.');
        }
        /** @var UserToken $tokenModel */
        $this->token = UserToken::find()
            ->notExpired()
            ->byType(UserToken::TYPE_CLIENT_REQUEST_ACCEPT)
            ->byToken($token)
            ->one();

        if (!$this->token) {
            throw new InvalidArgumentException('Wrong Request approval token or expired, Please contact Iresort');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->token->user;
        $user->password = $this->password;
        if ($user->save()) {
            $this->token->delete();
        };

        return true;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('frontend', 'Password')
        ];
    }
}
