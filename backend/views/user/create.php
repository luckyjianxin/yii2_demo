<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('用户管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加用户') ?></li>
        </ul>

        <div class="tab-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
    </div>

</div>
