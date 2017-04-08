<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Categories');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administration'), 'url' => ['site/admin']];
$this->params['breadcrumbs'][] = $pageName;
?>
<div class="category-index">

    <h1><?= Html::encode($pageName) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'slug',
            'code',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}'
            ],

        ],
    ]); ?>

</div>
