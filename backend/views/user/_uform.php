<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['id' => 'user-update', 'enableAjaxValidation' => true, 'validationUrl' => Url::toRoute(['validate-form', 'id' => $model->id])]); ?>

    		<?= $form->field($uform, 'username')->textInput(['autofocus' => true, 'disabled' => true, 'value' => $model->username]) ?>

            <?= $form->field($uform, 'email')->textInput(['value' => $model->email]) ?>

			<?= $form->field($uform, 'password')->passwordInput() ?>


			<?= $form->field($uform, 'status')->dropDownList(['10'=>'正常','0'=>'禁止'], ['prompt'=>'请选择']) ?>

		    <div class="form-group">
		        
		        <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
		    </div>

    <?php ActiveForm::end(); ?>

</div>