<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PublisherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Publishers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Administration'), 'url' => ['site/admin']];
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>

<div class="publisher-index">

    <h1><?= Html::encode($pageName) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Publisher'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
