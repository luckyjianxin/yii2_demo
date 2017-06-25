<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mailtemplate */

$this->title = '创建模板';
$this->params['breadcrumbs'][] = ['label' => 'Mailtemplates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailtemplate-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('模板管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加模板') ?></li>
        </ul>


		<div class="tab-content">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
