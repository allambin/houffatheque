<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Houffathèque';
?>
<div class="site-index">

    <div class="body-content">
        
        <div class="row marketing">
            <div class="col-lg-4">
                <?php echo Html::img('@web/img/icons/games.png') ?>
                <h2>Ludothèque</h2>
                <p>Jeux de société, jeux de plateau, jeux de cartes...</p>
                <p><a class="btn btn-default" role="button" href="<?= Url::to(['/ludotheque']); ?>">Découvrir »</a></p>
            </div>
            <div class="col-lg-4">
                <?php echo Html::img('@web/img/icons/library.png') ?>
                <h2>Bibliothèque</h2>
                <p>Catalogue</p>
                <p><a class="btn btn-default" role="button" href="<?= Url::to(['/bibliotheque']); ?>">Explorer »</a></p>
            </div>
            <div class="col-lg-4">
                <?php echo Html::img('@web/img/icons/map.png') ?>
                <h2>A propos</h2>
                <p>Renseignements pratiques et où nous trouver.</p>
                <p><a class="btn btn-default" role="button" href="<?= Url::to(['/renseignements']); ?>">Parcourir »</a></p>
            </div>
        </div>
        
        <hr class="featurette-divider">
        
        <div class="row">
            <div class="col-md-8">
                <div class="title"><h3>Evénements</h3></div>
                <?php foreach ($events as $event): ?>
                <h4><?= $event->title; ?><br /><small>du <?= date('d-m-Y', strtotime($event->start_date)); ?> au <?= date('d-m-Y', strtotime($event->end_date)); ?></small></h4>
                <?= $event->content; ?>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <div class="title"><h3>Derniers ajouts</h3></div>
                <?php foreach ($books as $book): ?>
                <dl>
                    <dt><?= $book->title; ?></dt>
                    <dd><?php echo $book->author ? $book->author->fullname : ''; ?></dd>
                </dl>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>
