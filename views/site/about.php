<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$pageName = 'Renseignements';
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = $pageName;
?>
<div class="site-about">
    <div class="row">
        <div class="col-md-12">
            <h1><?= Html::encode($pageName) ?></h1>
        </div>
        <div class="col-md-6">
            <h3>Coordonnées générales</h3>
            <address class="adr">
                <span class="block"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                    Bibliothèque publique de Houffalize<br  />
                    rue de Schaerbeek, 3/B <br />
                    6660 HOUFFALIZE<br />
                    Belgique
                </span>
                <span class="block"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>Téléphone : 061/289855</span>
                <span class="block"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:jean.lambin@skynet.be">jean.lambin@skynet.be</a></span>

            </address>
        </div>
        <div class="col-md-6"><h3>Bibliothécaires</h3>

            <span class="block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Jean LAMBIN<br />
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:jean.lambin@skynet.be">jean.lambin@skynet.be</a></span>
            <span class="block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Marie-Henriette LATTEUR<br />
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:jean.lambin@skynet.be">jean.lambin@skynet.be</a></span>
            </span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Horaires</h3>
            <span class="block"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>Lundi de 17 h à 18 h 30</span>
            <span class="block"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>Mardi de 15 h 30 à 17 h</span>
            <span class="block"><span class="glyphicon glyphicon-time" aria-hidden="true"></span>Samedi de 10 h à 12 h</span>
        </div>
        <div class="col-md-6">
            <h3>Tarifs</h3>
            <span class="block"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span>25 cts pour le prêt d'un livre pour 15 jours</span>
            <span class="block"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span>50 cts pour le prêt d'un jeu pour 15 jours</span>
            <span class="block"><span class="glyphicon glyphicon-euro" aria-hidden="true"></span>Le prêt des livres est gratuit pour les enfants, adolescents et étudiants.</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Divers</h3>
            <span class="block"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>Site créé par <a href="http://www.nonamehere.net/">Anne-Lise Lambin</a></span>
        </div>

        <div class="col-md-12">
            <h3>Où nous trouver ?</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5115.265688061791!2d5.789982!3d50.130592!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c013fa175fc3ff%3A0x409dd8ec71d5e994!2sRue+de+Schaerbeek+3%2C+6660+Houffalize%2C+Belgique!5e0!3m2!1sfr!2sbe!4v1428305584846" width="800" height="200" frameborder="0" style="border:0"></iframe>
        </div>
    </div>

</div>
