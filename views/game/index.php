<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GameSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Games');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>
<div class="game-index">

    <h1><?= Html::encode($pageName) ?> <?php if(Yii::$app->user->isAdmin()): ?><?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', ['create'], ['class' => 'btn btn-success']) ?><?php endif; ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'label' => Yii::t('app', 'Name'),
                'headerOptions' => ['width' => '40%']
            ],
            [
                'attribute' => 'comment',
                'label' => Yii::t('app', 'Comment'),
                'format' => 'raw',
                'filter' => true,
            ],

            [
                'class' => 'yii\grid\ActionColumn', 
                'visible' => Yii::$app->user->isAdmin(),
                'template' => '{update}{delete}'
            ],
        ],
    ]); ?>
    
    <h3><?= Yii::t('app', 'Search form') ?></h3>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

</div>
