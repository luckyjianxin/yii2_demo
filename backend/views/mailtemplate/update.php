<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mailtemplate */

$this->title = '更新模板: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mailtemplate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('模板管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('更新模板') ?></li>
        </ul>


		<div class="tab-content">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
