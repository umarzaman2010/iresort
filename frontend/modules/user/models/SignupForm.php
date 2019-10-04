<?php

namespace frontend\modules\user\models;

use cheatsheet\Time;
use common\commands\SendEmailCommand;
use common\models\User;
use common\models\UserProfile;
use common\models\UserToken;
use frontend\modules\user\Module;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{

    const AGE_19_ABOVE = 'Adult group - from 19 years and above';
    const AGE_6_19 = 'Adolescents - from 6 to 19 years';
    const AGE_6_BELOW = 'Kindergarten age group - less than six years';


  const LOVE_TO_PRACTICE = 'Love to practice equestrian';
    const SPORTS_CLUB = 'Sports Club (GYM)';
    const WOMEN_SALON = 'Women Salon and Osteopathy Center';
  const SUPPORT_SERVICES = 'Support services of sessions, gardens and walk';
    const LOVE_PLAYING_SPORTS = 'Love playing sports like tennis, football, basketball, volleyball, handball and badminton';
    const NURSERVER_ANG_GAME = 'Nursery and games area';


    /**
     * @var
     */
    public $username;

    /**
     * @var
     */
    public $firstname;
    /**
     * @var
     */
    public $lastname;
    /**
     * @var
     */
    public $contact_number;
    /**
     * @var
     */
    public $age_group;
    /**
     * @var
     */
    public $subscription_reason;
    /**
     * @var
     */
    public $recommend_fig;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            ['username', 'filter', 'filter' => 'trim'],
//            ['username','required'],
            ['firstname','required'],
            ['contact_number','required'],
            ['age_group','required'],
//            ['username', 'unique',
//                'targetClass' => '\common\models\User',
//                'message' => Yii::t('frontend', 'This username has already been taken.')
//            ],
//            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => '\common\models\User',
                'message' => Yii::t('frontend', 'This email address has already been taken.')
            ],

//            ['password', 'required'],
            ['subscription_reason', 'required'],
//            ['firstname', 'string', 'min' => 6],
//            ['lastname', 'string', 'min' => 6],
//            ['recommend_fig', 'string', 'min' => 6],
//            ['subscription_reason', 'string', 'min' => 15],
            ['age_group', 'default', 'value' => self::AGE_6_19],
            ['age_group', 'in', 'range' => array_keys(self::ageLimit())],

//            [['subscription_reason'], 'string', 'max' => 150],
//            ['subscription_reason', 'default', 'value' => self::LOVE_TO_PRACTICE],
            ['subscription_reason', 'in', 'range' => array_keys(self::subscriptionReason()), 'allowArray' => true],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('frontend', 'Username'),
            'firstname' => Yii::t('frontend', 'Full Name'),
            'lastname' => Yii::t('frontend', 'Last Name'),
            'contact_number' => Yii::t('frontend', 'Mobile No'),
            'age_group' => Yii::t('frontend', 'Age Group'),
            'subscription_reason' => Yii::t('frontend', 'Choose reasons for subscription'),
            'recommend_fig' => Yii::t('frontend', 'Important figures you recommend'),
            'email' => Yii::t('frontend', 'E-mail'),
            'password' => Yii::t('frontend', 'Password'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup()
    {
        if ($this->validate()) {

            $shouldBeActivated = $this->shouldBeActivated();
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = $shouldBeActivated ? User::STATUS_NOT_ACTIVE : User::STATUS_ACTIVE;

            $subscriptionReasons    =   implode(',',$this->subscription_reason);
//            echo $subscriptionReasons;exit;

//            echo '<PRE>';
//            print_r($this->subscription_reason);exit;
            $user->setPassword($this->password);
            if (!$user->save(false)) {
                throw new Exception("User couldn't be  saved");
            };

            $user->afterSignup(['firstname'=>$this->firstname,'contact_number'=>$this->contact_number,'age_group'=>$this->age_group,'subscription_reason'=>$subscriptionReasons,'recommend_fig'=>$this->recommend_fig]);
            if ($shouldBeActivated) {
                $token = UserToken::create(
                    $user->id,
                    UserToken::TYPE_ACTIVATION,
                    Time::SECONDS_IN_A_DAY
                );
                Yii::$app->commandBus->handle(new SendEmailCommand([
                    'subject' => Yii::t('frontend', 'Activation email'),
                    'view' => 'activation',
                    'to' => $this->email,
                    'params' => [
                        'url' => Url::to(['/user/sign-in/activation', 'token' => $token->token], true)
                    ]
                ]));
            }
            return $user;
        }

        return null;
    }

    /**
     * @return bool
     */
    public function shouldBeActivated()
    {
        /** @var Module $userModule */
        $userModule = Yii::$app->getModule('user');
        if (!$userModule) {
            return false;
        } elseif ($userModule->shouldBeActivated) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns user age list
     * @return array|mixed
     */
    public static function ageLimit()
    {
        return [
            self::AGE_19_ABOVE => Yii::t('common', 'Adult group - from 19 years and above'),
            self::AGE_6_19 => Yii::t('common', 'Adolescents - from 6 to 19 years'),
            self::AGE_6_BELOW => Yii::t('common', 'Kindergarten age group - less than six years')
        ];
    }

    /**
     * Returns subscription reason list
     * @return array|mixed
     */
    public static function subscriptionReason()
    {
        return [
            self::LOVE_TO_PRACTICE => Yii::t('common', 'Love to practice equestrian'),
            self::SPORTS_CLUB => Yii::t('common', 'Sports Club (GYM)'),
            self::WOMEN_SALON => Yii::t('common', 'Women Salon and Osteopathy Center'),
            self::SUPPORT_SERVICES => Yii::t('common', 'Support services of sessions, gardens and walk'),
            self::LOVE_PLAYING_SPORTS => Yii::t('common', 'Love playing sports like tennis, football, basketball, volleyball, handball and badminton'),
            self::NURSERVER_ANG_GAME => Yii::t('common', 'Nursery and games area')
        ];
    }
}
