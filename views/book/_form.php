<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ISBN')->textInput(['maxlength' => 45]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => 4]) ?>
    
    <?= $form->field($model, 'category_id')->dropDownList(
      ArrayHelper::map($categories, 'id', 'name'), ['prompt'=>'']) ?>
    
    <?= $form->field($model, 'collectionName')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Collection')) ?>
    
    <?= $form->field($model, 'publisherName')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Publisher')) ?>
    
    <?= $form->field($model, 'authorFullname')->textInput(['maxlength' => 255])->label(Yii::t('app', 'Author')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
