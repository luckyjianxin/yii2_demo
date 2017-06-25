<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mailhistory */

$this->title = 'Create Mailhistory';
$this->params['breadcrumbs'][] = ['label' => 'Mailhistories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailhistory-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
