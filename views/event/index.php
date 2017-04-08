<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Events');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>
<div class="event-index">

    <h1><?= Html::encode($pageName) ?> <?php if(Yii::$app->user->isAdmin()): ?><?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', ['create'], ['class' => 'btn btn-success']) ?><?php endif; ?></h1>
        
    <?php foreach($events as $event): ?>
    <h4><?= $event->title; ?><br /><small>du <?= date('d-m-Y', strtotime($event->start_date)); ?> au <?= date('d-m-Y', strtotime($event->end_date)); ?></small></h4>
    <?= $event->content; ?>
    <?php if(!$event->is_published): echo '<p class="bg-warning"><small>Evénement non publié</small></p>'; endif; ?>
    <?php endforeach; ?>

</div>
