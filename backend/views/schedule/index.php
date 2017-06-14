<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use yii\widgets\Pjax;

use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '行程管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<section>
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="schedule-index">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('行程管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加行程', ['create']) ?></li>
        </ul>

        <div class="tab-content">

<!--     <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Schedule', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php Pjax::begin(['id' => 'schedules', 'timeout' => false, 'enablePushState' => false,]); ?>    

 <form> 
<?php 

$colums =   [
                ['class' => 'yii\grid\SerialColumn',
                 'options' => [
                    'width'=> '50px'
                 ]
                ],

                // 'Name',
                ['attribute'  => 'name',
                  'class' => '\kartik\grid\EditableColumn',
                  'editableOptions'=>  [ 'formOptions' => ['action' => ['/schedule/editschedule']],
                                         'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
                                            'options' => [
                                                'rows' => 4, 
                                            ],

                  ],
                ],
                
                //is_default
                ['class' => 'backend\widgets\grid\SwitcherColumn',
                 'attribute' => 'is_default',
                 'options' => [
                    'width'=> '50px'
                 ]                 
                ],                

                
                // [ 'class' => '\kartik\grid\BooleanColumn',
                //   'attribute' => 'is_default',
                //   'trueLabel' => 'Yes', 
                //   'falseLabel' => 'No',
                //   'trueIcon'  => '<label class="btn btn-success">Yes</label>',
                //   'falseIcon'  => '<label class="btn btn-danger">No</label>',
                // ],

            
                //action button
                [ 'class' => '\kartik\grid\ActionColumn',
                  'template' => '{delete}',
                  'header' => '',
                  'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>'],
                  'buttons' => [
                    // 'default' => function ($url, $model) {
                        
                    //     $options = [
                    //         'title' => Yii::t('app', '更新默认'),
                    //         'data-pjax' => '1',
                    //         'data-toggle-default' => $model->id,
                    //         'data-pjax-container' => 'w0-pjax'
                    //     ];
                    //     return Html::a('<span class="glyphicon glyphicon-cog"></span>', $url, $options); 
                    // },
                  ],
                  'urlCreator'  => function ($action, $model, $key, $index) {
                        return Url::to(["schedule/" . $action, "id" => $model->id]);
                  }
                ]
            ];

 ?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterUrl' => Url::to(["schedule/index"]),
        'columns' => $colums,
        'pjax'=> true,
        'summary'=>false,
        'pjaxSettings' => [
            'options' => [
                'enablePushState' => false,
            ]
        ],
        //'export' => false,//导出数据按钮
        //'toggleData' => false,//显示全部数据按钮
        // 'toolbar' => [
        //     [
        //         'content'=>
        //             Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], [
        //                 'type'=>'button', 
        //                 'title'=>Yii::t('app', 'Add Schedule'), 
        //                 'class'=>'btn btn-success',
        //                 'style'=>'margin-right: 5px;'
        //             ]) . ' '.
        //             Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], [
        //                 'class' => 'btn btn-default', 
        //                 'title' => Yii::t('app', 'Reset Grid')
        //             ]),
        //         'options' => ['class' => 'btn-group-sm']
        //     ],
        // ],
        // 'panel' => [
        //     'heading'=>'<h1 class="panel-title"> <h3>Schedules</h3></h1>',
        //     'type'=>'primary',
        //     'footer'=>false
        // ],
    ]); ?>

</form>
<?php Pjax::end(); ?>

</div>
</div>
</div>
</section>

