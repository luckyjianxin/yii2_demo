<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\helpers\MyUtils;
/* @var $this yii\web\View */
/* @var $searchModel common\models\MailhistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '邮件历史';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailhistory-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('历史记录管理', ['index']) ?></li>
            <!-- <li role="presentation"><?= Html::a('添加模板', ['create']) ?></li> -->
        </ul>


        <div class="tab-content">
            <?php Pjax::begin(['id' => 'mail_history']); ?>    
              <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'kartik\grid\SerialColumn',
                        'width'=>'50px',
                        ],
                        ['attribute' => 'enquiry_id',
                         'width'=>'100px',
                         'value' => function($model) {
                            return ($model->enquiry_id != 0) ? MyUtils::customerId($model->enquiry_id) : 0;
                         }
                        ],
                        ['attribute' => 'customer_id',
                         'width'=>'110px',
                         'value' => function($model) {
                            return ($model->customer_id != 0) ? MyUtils::customerId($model->customer_id) : 0;
                         }
                        ],
                        ['attribute' => 'type',
                         'width'=>'120px',
                         'value' => function($model) {
                            return ($model->type == 1) ? 'Normal' : 'Bank Transfer';
                         },
                         'filterType'=>GridView::FILTER_SELECT2,
                         'filter'=>['1' => 'Normal', '2' => 'Bank Transfer'], 
                         'filterWidgetOptions'=>[
                            'pluginOptions'=>['allowClear'=>true],
                         ],
                         'filterInputOptions'=>['placeholder'=>'Any Type'],
                         'group' => false,  // enable grouping
                        ],
                        // 'mail_from',
                        'mail_to',
                        // 'subject',
                        // 'content:ntext',
                        // 'attachements',
                        // 'operator',
                        ['attribute' => 'info',
                         'format' => 'html',
                         'value' => function($model) {
                            return ($model->info == 'success') ? '<h5 class="text-success">'. $model->info.'</h5>' : '<h5 class="text-danger">'.$model->info.'</h5>' ;
                         }
                        ],

                        [   'attribute'=>'create_at',
                            'width' => '150px',
                            'mergeHeader' => 'false',
                            // 'filterType' => GridView::FILTER_DATE_RANGE,
                            // 'filterWidgetOptions' =>([
                            //     'model'=>$searchModel,
                            //     'attribute'=>'create_at',
                            //     'presetDropdown'=>TRUE,
                            //     // 'convertFormat'=>true,
                            //     'pluginOptions'=>[
                            //         'format'=>'Y-m-d',
                            //         'locale' => [
                            //             'cancelLabel' => 'Clear',
                            //             'format' => 'Y-m-d',
                            //         ]
                            //     ],
                            // ]),
                        ],
                        ['class' => 'kartik\grid\ActionColumn',
                         'template' => '{view} {delete}',
                         'width' => '80px',
                         'viewOptions'=>['label' => '<span class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-eye-open"></i></span>'],
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
                    'pjaxSettings' => [
                        'options' => [
                            'id' => 'mail_history'
                        ]
                    ],
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => GridView::TYPE_INFO,
                        'heading'=> '',
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

