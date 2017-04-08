<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use letyii\tinymce\Tinymce;

/* @var $this yii\web\View */
/* @var $model app\models\Game */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'comment')->widget(Tinymce::className(), [
        'options' => [
            'class' => 'tinymce',
        ],
        'configs' => [ // Read more: http://www.tinymce.com/wiki.php/Configuration
            'menubar' => 'tools table format view insert edit'
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
