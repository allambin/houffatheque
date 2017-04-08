<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$pageName = Yii::t('app', 'Bibliothèque');
$this->title = Yii::$app->params['siteName'] . ' - ' . $pageName;
$this->params['breadcrumbs'][] = ['label' => $pageName, 'url' => ['/bibliotheque']];
$this->params['breadcrumbs'][] = !is_null($category) ? $category->name : Yii::t('app', 'Complete list');
?>

<div class="book-index">

    <h1><?= Html::encode($pageName) ?> <?php if(Yii::$app->user->isAdmin()): ?><?= Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('<span class="glyphicon glyphicon-upload" aria-hidden="true"></span>', ['import'], ['class' => 'btn btn-success']) ?><?php endif; ?></h1>
    
    <ul class="category-list">
    <?php foreach($categories as $cat): ?>
        <li><?php if(!is_null($category) && $category->name == $cat->name): ?><?= $cat->name; ?><?php else: ?><a href="<?= \Yii::$app->urlManager->createUrl(['bibliotheque', 'id' => $cat->id, 'slug' => $cat->slug]) ?>"><?= $cat->name; ?></a><?php endif; ?></li>
    <?php endforeach; ?>
    </ul>
    
    <nav class="alphabetical">
        <ul class="pagination">
            <?php foreach (range('A', 'Z') as $char): ?>
            <?php $url_params = is_null($category) ? ['bibliotheque', 'letter' => $char, 'page' => 1] : ['bibliotheque', 'id' => $category->id, 'slug' => $category->slug, 'letter' => $char, 'page' => 1];?>
            <li><a href="<?php echo \Yii::$app->urlManager->createUrl($url_params) ?>"><?= $char ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'booklist'],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'ISBN',
            [
                'attribute' => 'author',
                'label' => Yii::t('app', 'Author'),
                'value' => 'author.fullname',
                'headerOptions' => ['width' => '20%']
            ],
            [
                'attribute' => 'title',
                'label' => Yii::t('app', 'Title'),
                'headerOptions' => ['width' => '40%']
            ],
            [
                'attribute' => 'publisher',
                'label' => Yii::t('app', 'Publisher'),
                'value' => 'publisher.name',
            ],
            [
                'attribute' => 'collection',
                'label' => Yii::t('app', 'Collection'),
                'value' => 'collection.name',
                'headerOptions' => ['width' => '15%']
            ],
            [
                'attribute' => 'year',
                'label' => Yii::t('app', 'Year'),
                'headerOptions' => ['width' => '5%']
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
