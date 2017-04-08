<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-inline'],
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-default']) ?>
        <?= Html::resetButton('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
