<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use letyii\tinymce\Tinymce;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'content')->widget(Tinymce::className(), [
        'options' => [
            'class' => 'tinymce',
        ],
        'configs' => [ // Read more: http://www.tinymce.com/wiki.php/Configuration
            'menubar' => 'tools table format view insert edit'
        ],
    ]); ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
        'options' => [],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
        'options' => [],
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
