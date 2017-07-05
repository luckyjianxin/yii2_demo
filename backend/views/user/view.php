<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = '查看用户';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('用户管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加用户', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('查看用户', ['view', 'id' => $model->id]) ?></li>
        </ul>

        <div class="tab-content">

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-striped table-bordered detail-view'],
                'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>', 
                'attributes' => [
                    'id',
                    'username',
                    // 'password_hash',
                    // ['attribute' => 'password_hash',
                    //  'label' => 'Password',
                    //  'value' => function($model) {
                    //     return ;
                    //  }
                    // ],

                    // 'password_reset_token',
                    'email:email',
                    ['attribute' => 'status',
                     'label' => 'Status',
                     'format' => 'html',
                     'value' => function($model) {
                        $status_str = \common\models\User::getUserStatus($model->status);
                        if ($model->status) {
                            return '<span class="label label-success">'.$status_str.'</span>';
                        } else {
                            return '<span class="label label-danger">'.$status_str.'</span>';
                        }
                     }
                    ],
                    ['attribute' => 'created_at',
                     'label' => 'Created Date',
                     'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                    ['attribute' => 'updated_at',
                     'label' => 'Updated Date',
                     'format' => ['date', 'php:Y-m-d H:i:s'],
                    ],
                ],
            ]) ?>
        </div>
    </div>


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
