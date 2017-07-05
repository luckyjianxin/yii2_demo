<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '模板管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailtemplate-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('模板管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加模板', ['create']) ?></li>
        </ul>


<div class="tab-content">
<?php Pjax::begin(['id' => 'mail-templates']); ?>    
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn',
             'width'=>'50px',
            ],

            // 'id',
            ['attribute'=>'type',
             'value'=>function ($model, $key, $index, $widget) {
                return ($model->type == 1) ? 'Normal' :'Bank Transfer';
             },
             'width'=>'120px',
            ],
            'subject',
            ['attribute' => 'content',
             'format'=>'html', 
            ],
            ['attribute'=>'create_at',
             'width' => '100px',
            ],

            ['class' => 'kartik\grid\ActionColumn',
             'template' => '{update} {delete}',
             'width' => '80px',
             'updateOptions'=>['label' => '<span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></span>'],
             'deleteOptions'=>['label' => '<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></span>'], 
             'header' => '',
             'buttons' => [
                
             ],
            ],
        ],
        'toolbar' =>  [
            ['content'=>''
            ]
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
</div>
</div>
