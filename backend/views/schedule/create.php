<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Schedule */

$this->title = '添加行程';
$this->params['breadcrumbs'][] = ['label' => 'Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section >
	<div class="schedule-create">
		<h1><?= Html::encode($this->title) ?></h1>
		<div class="nav-tabs-custom">
	        <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" ><?= Html::a('行程管理', ['index']) ?></li>
	            <li role="presentation" class="active"><?= Html::a('添加行程', ['create']) ?></li>
	        </ul>
	        <div class="tab-content">	  
			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>
			</div>
		</div>
	</div>
</section>

