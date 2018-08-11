<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
/** var $model app\modules\news\models\news */
$image = str_replace(\Yii::getAlias('@webroot'),\Yii::getAlias('@web'),$model->main_image);
?>
<div class="post">
    <h2><?= Html::a($model->title,Url::to('/news/lihat/'.$model->permalink)) ?></h2>
    <?= Html::a(Html::img($image,['style'=>'max-width:300px']),Url::to('/news/lihat/'.$model->permalink))?>
    <?= HtmlPurifier::process($model->teaser) ?>
</div>