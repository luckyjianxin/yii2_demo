<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="user-index">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('用户管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加用户', ['create']) ?></li>
        </ul>

        <div class="tab-content">

         <?php Pjax::begin(['id' => 'user-lists']); ?>    
            <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn'],

                        ['attribute' => 'id',
                         'width' => '80px'
                        ],
                        'username',
                        // 'auth_key',
                        // 'password_hash',
                        // 'password_reset_token',
                        'email:email',
                        ['width' => '120px',
                         'hAlign' => 'center',
                         'attribute' => 'status',
                         'format'=>'html',
                         'filter' => Html::activeDropDownList($searchModel, 'status', User::getUserStatus(), ['class' => 'form-control']),
                         'value' => function($model) {
                            $status_str = User::getUserStatus($model->status);
                            if ($model->status) {
                                return '<span class="label label-success">'.$status_str.'</span>';
                            } else {
                                return '<span class="label label-danger">'.$status_str.'</span>';
                            }
                            
                         },
                        ],

                        ['class' => '\kartik\grid\DataColumn',
                         'attribute' => 'created_at',
                         'format'=>['date', 'php:Y-m-d H:i:s'],
                         'filterType' => GridView::FILTER_DATE,
                         'filterWidgetOptions' => [
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true
                            ]
                         ],
                         // 'value' => function($model) {
                         //    return date("Y-m-d H:i:s", $model->created_at);
                         // },
                         'width' => '210px',
                         // 'mergeHeader' => true,
                        ],
                        // 'updated_at',

                        ['class' => 'kartik\grid\ActionColumn',
                         'header' => '',
                        ],
                    ],
                    'toolbar' =>  [
                        ['content'=>''
                        ]
                    ],
                    'pjax' => true,
                    'pjaxSettings' => [
                        'options' => [
                            'id' => 'user-lists'
                        ]
                    ],
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'heading'=>'',
                        'type' => GridView::TYPE_INFO,
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
      </div>
    </div>
</div>
