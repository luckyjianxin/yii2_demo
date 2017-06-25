<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MailhistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mailhistory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enquiry_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'mail_from') ?>

    <?php // echo $form->field($model, 'mail_to') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'attachements') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
