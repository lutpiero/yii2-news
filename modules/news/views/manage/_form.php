<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\redactor\widgets\Redactor;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-7">
<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permalink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teaser')->widget(Redactor::className()) ?>

    <?= $form->field($model, 'article')->widget(Redactor::className()) ?>

    <?= $form->field($model, 'main_image')->fileInput() ?>
    <?= $form->field($model, 'author')->dropDownList($model->getAuthors()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
<?php

$script =
    "
    String.prototype.replaceArray = function(find, replace) {
      var replaceString = this;
      var regex; 
      for (var i = 0; i < find.length; i++) {
        regex = new RegExp(find[i], \"g\");
        replaceString = replaceString.replace(regex, replace[i]);
      }
      return replaceString;
    };
    var find = [\" \", \",\"];
    var replace = [\"-\",\"-\"];
    function br2nl(str) {
        return str.replace(/<br\\s*\\/?>/mg,\"\");
    }
    $('#news-title').change(function(e){
        var newStr = $('#news-title').val().replaceArray(find,replace).toLowerCase()
        $('#news-permalink').val(newStr)
    })";
$this->registerJs($script,\yii\web\View::POS_READY);

?>

