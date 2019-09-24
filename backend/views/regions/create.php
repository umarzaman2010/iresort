<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Regions */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Regions',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regions-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
