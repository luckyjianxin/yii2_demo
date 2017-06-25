<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mailtemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailtemplate-form">

    <?php $form = ActiveForm::begin(['id' => 'template-form']); ?>

	<? echo $form->field($model, 'type')->dropDownList(['1' => 'Normal', '2' => 'Bank Transfer'], ['prompt'=>'请选择类型']) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->
    <div class="form-group">
      <label for="">Content</label>
      <script id="mailtemplate-content" type="text/plain"  style="width: 100%; height: 300px;"></script>
      <input type="hidden" name="Mailtemplate[content]" id="content" class="form-control" value="">
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::button('Back', ['id' => 'back_btn', 'class' => 'btn btn-normal']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php \backend\assets\UeditorAsset::register($this); ?>

<?php $this->beginBlock('mail-form'); ?>

	$(document).ready(function() {
		var ueditor = UE.getEditor('mailtemplate-content');
		ueditor.ready(function() {
		  ueditor.setContent('<?php echo $model->content;   ?>');
		},2);

		$('#back_btn').click(function() {
			history.go(-1);
		});


		$(document).on("beforeSubmit", "#template-form", function () {
		    $("#content").val(ueditor.getContent());
		});
	});
    

	



<?php $this->endBlock();  $this->registerJs($this->blocks['mail-form'], View::POS_END); ?>


