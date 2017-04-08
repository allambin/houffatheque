<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Import Books');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-import">
    
    <div class="form">
        <?php $form = ActiveForm::begin([
                    'options' => ['enctype'=>'multipart/form-data']
                ]); ?>

         <?php //echo $form->errorSummary($model); ?>

        <div class="form-group">
            <label class="control-label">Upload Document</label>
            <?= FileInput::widget([
                'name' => 'csvfile',
            ]); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?= Yii::t('app', 'Category'); ?></label>    
            <?= Html::dropDownList('category', null,
              ArrayHelper::map(app\models\Category::find()->orderBy('id')->all(), 'id', 'name'), []) ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Import'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <a href="/csv/houffatheque.csv">Exemple de CSV</a>
    </div>
    
</div>
