<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publisher */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Publisher',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administration'), 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publishers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="publisher-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
