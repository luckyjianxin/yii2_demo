<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = '添加场景';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<section >
	<div class="scene-create">
		<h1><?= Html::encode($this->title) ?></h1>
		<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" ><?= Html::a('行程管理', ['index']) ?></li>
	            <li role="presentation"><?= Html::a('添加行程', ['create']) ?></li>
	            <li role="presentation" class="active"><?= Html::a('添加场景', ['addscene', 'id' => $model->id]) ?></li>
	        </ul>
	        <div class="tab-content">	 
	            <div class="text-center text-info"><h3><?= Html::encode($model->name) ?></h3></div>
			    <?= $this->render('_scenelist', [
			    	'model' => $model,
			        'scenes' => $scenes,
			    ]) ?>
			</div>
		</div>
	</div>
</section>

