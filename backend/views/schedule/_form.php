<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="container-fluid clearfix">
  	<div class="row">
  			<div class="schedule-form">

			    <?php $form = ActiveForm::begin(); ?>

			    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			    <?= $form->field($model, 'is_default')->checkbox([]) ?>

			    <div class="form-group">
			        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    </div>

			    <?php ActiveForm::end(); ?>

			</div>

  	</div>
  </div>

