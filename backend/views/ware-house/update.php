<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WareHouse */

$this->title = Yii::t('backend', 'Update {modelClass}: ', [
    'modelClass' => 'Ware House',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Ware Houses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="ware-house-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
