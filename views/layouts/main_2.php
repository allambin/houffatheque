<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
<?php $this->head() ?>
    </head>
    <body>

        <div class="container">
            <div class="header clearfix">
<!--                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="#">Home</a></li>
                        <li role="presentation"><a href="#">About</a></li>
                        <li role="presentation"><a href="#">Contact</a></li>
                    </ul>
                </nav>-->
<nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Houffathèque</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?= Url::to(['site/index']); ?>">Accueil</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Renseignements</a></li>
                                <li><a href="<?= Url::to(['/catalogue']); ?>">Catalogue</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Ludothèque</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Evénements</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!--<h3 class="text-muted">Project name</h3>-->
            </div>
        </div>
        
        <?php // echo Html::img('@web/img/img048.jpg', ['class' => 'second-slide', 'class'=>'thing']) ?>
        
<!-- Section 2 -->
<section id="home" data-speed="4" data-type="background">
    <div class="container">
        More content goes here!
    </div>
</section>
        
<!--        <div class="navbar-wrapper">
            <div class="container">

                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Houffathèque</a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="<?= Url::to(['site/index']); ?>">Accueil</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Renseignements</a></li>
                                <li><a href="<?= Url::to(['/catalogue']); ?>">Catalogue</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Ludothèque</a></li>
                                <li><a href="<?= Url::to(['site/index']); ?>">Evénements</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>

            </div>
        </div>-->

        <div class="container marketing">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>

            <hr class="featurette-divider">


            <!-- FOOTER -->
            <footer>
                <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; 2014 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
            </footer>

        </div><!-- /.container -->
    <!--</body>-->
<?php $this->endBody() ?>
    <script>
        $(document).ready(function(){
            // cache the window object
            $window = $(window);

            $('section[data-type="background"]').each(function(){
              // declare the variable to affect the defined data-type
              var $scroll = $(this);

               $(window).scroll(function() {
                 // HTML5 proves useful for helping with creating JS functions!
                 // also, negative value because we're scrolling upwards                            
                 var yPos = -($window.scrollTop() / $scroll.data('speed'));

                 // background position
                 var coords = '90% '+ yPos + 'px';

                 // move the background
                 $scroll.css({ backgroundPosition: coords });   
               });
            });
         });
    </script>
    <!--</html>-->
<?php $this->endPage() ?>
