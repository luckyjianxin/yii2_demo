<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Officecontact */

$this->title = '添加门店';
$this->params['breadcrumbs'][] = ['label' => 'Offices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="officecontact-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('门店管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加门店') ?></li>
        </ul>


		<div class="tab-content">

		    <?= $this->render('_form', [
		        'model' => $model,
		        'branchs' => $branchs
		    ]) ?>
		</div>
	</div>	
</div>
