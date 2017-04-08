<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => Url::current(),
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'ISBN') ?>

    <?= $form->field($model, 'year') ?>
    
    <?php echo $form->field($model, 'author') ?>
    
    <?php echo $form->field($model, 'publisher') ?>
    
    <?php echo $form->field($model, 'collection') ?>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
