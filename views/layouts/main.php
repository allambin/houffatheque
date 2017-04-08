<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\helpers\BaseHtml;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" id="test">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href='http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' rel='stylesheet' type='text/css'>
        <style type="text/css">
            #banner { background: url(../img/slide<?= rand(1, 3); ?>.jpg) no-repeat center top; }
        </style>
    </head>
    <body>

        <div class="container">
            <div id="header">
                <div class="row">
                    <div class="col-md-8">
                        <?php echo Html::img('@web/img/titre.jpg') ?>
                    </div>
                    <div class="col-md-4">
                        
                        <?= BaseHtml::beginForm('/book/index', 'get', ['class' => 'form-inline hidden-xs']); ?>
                            <div class="form-group">
                                <div class="input-group">
                                    <?= BaseHtml::input('text', 'search', '', ['class' => 'form-control', 'placeholder' => 'Titre, collection, ...']); ?>
                                </div>
                            </div>
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                            
                        <?= BaseHtml::endForm(); ?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="banner"></div>
                    </div>
                </div>
            </div>
            
            <?php
            NavBar::begin([
                'options' => [
                    'class' => 'navbar navbar-default',
                ],
            ]);
            
            $current = trim(Url::current(), '/');
            $current = ($current == 'book/index') ? 'bibliotheque' : $current;
            $current = ($current == 'game/index') ? 'ludotheque' : $current;
            $current = ($current == 'event/index') ? 'evenements' : $current;
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-collapse'],
                'route' => $current,
                'items' => [
                    ['label' => 'Accueil', 'url' => ['/']],
                    ['label' => 'Renseignements', 'url' => ['/renseignements']],
                    ['label' => 'Bibliothèque', 'url' => ['/bibliotheque']],
                    ['label' => 'Ludothèque', 'url' => ['/ludotheque']],
                    ['label' => 'Evénements', 'url' => ['/evenements']],
                    ['label' => 'Administration', 'url' => ['/administration'], 'visible' => Yii::$app->user->isAdmin()],
                    ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'], 'visible' => Yii::$app->user->isAdmin()],
                ],
            ]);
            
            NavBar::end();
            ?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
			
            <?php
            foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
                    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            }
            ?>

            <?= $content ?>

            <hr class="featurette-divider">

            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">Retour en haut</a></p>
                <p>&copy; 2015 Houffathèque</p>
            </footer>
        </div>
            
    <?php $this->endBody() ?>
<?php $this->endPage() ?>
