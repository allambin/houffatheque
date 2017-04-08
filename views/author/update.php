<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Author',
]) . ' ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administration'), 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
