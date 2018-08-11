<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            ['attribute'=>'permalink',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a(Url::to('/news/lihat/'.$model->permalink),
                        Url::to('/news/lihat/'.$model->permalink),
                        ['target'=>'_blank','data-pjax'=>0]
                        //['onclick' => "window.open ('".Url::to('/news/lihat/'.$model->permalink)."'); return false",]
                        );
                }
            ],
            'teaser:html',
            'article:html',
            'author',
            ['attribute'=>'main_image',
            'format'=>'html',
            'value'=>function($model){
                $image = str_replace(\Yii::getAlias('@webroot'),\Yii::getAlias('@web'),$model->main_image);
                return Html::img($image,['width'=>'100px']);
            }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>