<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\WareHouse */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Ware House',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ware Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ware-house-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
