<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$pageName = Yii::t('app', 'Administration');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>
<div class="site-admin">
    <ul>
        <li><a href="<?= \Yii::$app->urlManager->createUrl(['category']) ?>"><?= Yii::t('app', 'Categories') ?></a></li>
        <li><a href="<?= \Yii::$app->urlManager->createUrl(['publisher']) ?>"><?= Yii::t('app', 'Publishers') ?></a></li>
        <li><a href="<?= \Yii::$app->urlManager->createUrl(['author']) ?>"><?= Yii::t('app', 'Authors') ?></a></li>
        <li><a href="<?= \Yii::$app->urlManager->createUrl(['collection']) ?>"><?= Yii::t('app', 'Collections') ?></a></li>
    </ul>
</div>
