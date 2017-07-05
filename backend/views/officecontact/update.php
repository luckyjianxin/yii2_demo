<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Officecontact */

$this->title = '(' . Html::encode($branchs[$model->branch]) . ') ' . Html::encode($model->address);
$this->params['breadcrumbs'][] = ['label' => 'Offices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="officecontact-update">

    <h1><?= Html::encode($this->title) ?></h1>
	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('门店管理', ['index']) ?></li>
            <li role="presentation" ><?= Html::a('添加门店', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('更新门店') ?></li>
        </ul>

		<div class="tab-content">
		    <?= $this->render('_form', [
		        'model' => $model,
		        'branchs' => $branchs
		    ]) ?>
	   </div>
   </div>
</div>
