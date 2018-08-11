<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
/** var $model app\modules\news\models\news */
$image = str_replace(\Yii::getAlias('@webroot'),\Yii::getAlias('@web'),$model->main_image);
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['/news/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post">
    <h2><?= Html::a($model->title,Url::to('/news/lihat/'.$model->permalink)) ?></h2>
    <?= Html::a(Html::img($image,['style'=>'max-width:500px']),Url::to('/news/lihat/'.$model->permalink))?>
    <?= HtmlPurifier::process($model->article) ?>
    (<?= HtmlPurifier::process($model->author) ?>)
</div>