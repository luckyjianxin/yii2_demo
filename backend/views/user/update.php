<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('用户管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加用户', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('修改用户', ['update', 'id' => $model->id]) ?></li>
        </ul>

        <div class="tab-content">
    <?= $this->render('_uform', [
        'model' => $model,
        'uform' => $uform,
    ]) ?>
    </div>
    </div>

</div>
