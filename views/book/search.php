<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Search results');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>

<div class="book-index">

    <h1><?= Html::encode($pageName) ?></h1>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'ISBN',
            'year',
            [
            'attribute' => 'collections',
            'label' => Yii::t('app', 'Collections'),
            'format' => 'raw',
            'value' => function ($model) {
                $collections = [];
                if ($model->collections) {
                    foreach ($model->collections as $collection) {
                        $collections[] = $collection->name;
                    }
                }
                return implode('<br />', $collections);
                },
            'filter' => true,
            ],
            [
            'attribute' => 'publishers',
            'label' => Yii::t('app', 'Publishers'),
            'format' => 'raw',
            'value' => function ($model) {
                $publishers = [];
                if ($model->publishers) {
                    foreach ($model->publishers as $publisher) {
                        $publishers[] = $publisher->name;
                    }
                }
                return implode('<br />', $publishers);
                },
            'filter' => true,
            ]

            //['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
