<?php

use common\grid\EnumColumn;
use common\models\User;
use trntv\yii\datetime\DateTimeWidget;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
//        echo Html::a(Yii::t('backend', 'Create {modelClass}', [
//    'modelClass' => 'User',
//]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [
            'class' => 'grid-view table-responsive'
        ],
        'columns' => [
//            'id',
            [
//                'class' => EnumColumn::class,
                'attribute' => 'id',
//                'enum' => User::statuses(),
                'filter' => false,
            ],
//            'username',
            [
                'class' => EnumColumn::class,
                'attribute' => 'id',
                'filter'=>false,
                'header'=>'Name',
                'value'=>function($data){
                  $profile  =     \common\models\UserProfile::findOne($data->id);
                    return $profile->firstname.' '.$profile->lastname;
                }
//                'enum' => User::statuses(),
//                'filter' => User::statuses()
            ],
//            'email:email',
            [
//                'class' => EnumColumn::class,
                'attribute' => 'email',
//                'enum' => User::statuses(),
                'filter' =>false,
            ],
//            [
//                'class' => EnumColumn::class,
//                'attribute' => 'status',
//                'enum' => User::statuses(),
//                'filter' => User::statuses()
//            ],
            [
//                'class' => EnumColumn::class,
                'attribute' => 'id',
                'filter'=>false,
                'header'=>'Mobile No',
                'value'=>function($data){
                    $profile  =     \common\models\UserProfile::findOne($data->id);
                    return $profile->contact_number;
                }

            ],

            [
//                'class' => EnumColumn::class,
                'attribute' => 'id',
                'header'=>'Age Group',
                'filter'=>false,
                'value'=>function($data){
                    $profile  =     \common\models\UserProfile::findOne($data->id);
                    return $profile->age_group;
                }

            ],
            [
//                'class' => EnumColumn::class,
                'attribute' => 'subscription_reason',
//                'header'=>'Subscription Reason',
                'value'=>function($data){
                    $profile  =     \common\models\UserProfile::findOne($data->id);
                    return $profile->subscription_reason;
                }

            ],
            [
//                'class' => EnumColumn::class,
//                'attribute' => 'recommend_fig',
                'header'=>'Recommended Figures',
                'value'=>function($data){
                    $profile  =     \common\models\UserProfile::findOne($data->id);
                    return $profile->recommend_fig;
                }

            ],
            [
                'class' => EnumColumn::class,
                'attribute' => 'request_status',
                'enum' => User::requestStatuses(),
                'filter' => User::requestStatuses()
            ],
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'filter' => DateTimeWidget::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'phpDatetimeFormat' => 'dd.MM.yyyy',
                    'momentDatetimeFormat' => 'DD.MM.YYYY',
                    'clientEvents' => [
                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
                    ],
                ])
            ],
//            [
//                'attribute' => 'logged_at',
//                'format' => 'datetime',
//                'filter' => DateTimeWidget::widget([
//                    'model' => $searchModel,
//                    'attribute' => 'logged_at',
//                    'phpDatetimeFormat' => 'dd.MM.yyyy',
//                    'momentDatetimeFormat' => 'DD.MM.YYYY',
//                    'clientEvents' => [
//                        'dp.change' => new JsExpression('(e) => $(e.target).find("input").trigger("change.yiiGridView")')
//                    ],
//                ])
//            ],
//             'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{accept}{reject}{update}{delete} ',
                'buttons' => [
                    'accept' => function ($url) {
                        return Html::a(
                            '<i class="fa fa-check" aria-hidden="true"></i>',
                            $url,
                            [
                                'title' => Yii::t('backend', 'Accept')
                            ]
                        );
                    },
                    'reject' => function ($url) {
                        return Html::a(
                            '<i class="fa fa-close" aria-hidden="true"></i>',
                            $url,
                            [
                                'title' => Yii::t('backend', 'Reject')
                            ]
                        );
                    },
//                    'login' => function ($url) {
//                        return Html::a(
//                                '<i class="fa fa-sign-in" aria-hidden="true"></i>',
//                                $url,
//                                [
//                                    'title' => Yii::t('backend', 'Login')
//                                ]
//                        );
//                    },


                ],
//                'visibleButtons' => [
//                    'login' => Yii::$app->user->can('administrator')
//                ]

            ],
        ],
    ]); ?>

</div>
