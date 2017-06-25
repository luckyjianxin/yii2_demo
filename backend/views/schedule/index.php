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
<?php Pjax::begin(['id' => 'schedules']); ?>    

<?php 

$colums =   [
                ['class' => 'kartik\grid\SerialColumn',
                 'options' => [
                    'width'=> '50px'
                 ]
                ],

                // 'Name',
                ['attribute'  => 'name',
                  'class' => '\kartik\grid\EditableColumn',
                  'editableOptions'=>  [ 'formOptions' => ['action' => ['/schedule/editschedule']],
                                         'size'=>'md',
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
                  'template' => '{add} {delete}',
                  'header' => '',
                  'deleteOptions' => ['label' => '<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></span>'],
                  'buttons' => [
                    'add' => function ($url, $model) {
                        
                        $options = [
                            'title' => Yii::t('app', '添加场景'),
                            'data-pjax' => 'false',
                        ];
                        return Html::a('<span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></span>', URL::to(['schedule/addscene', 'id'=>$model->id]), $options); 
                    },
                  ],
                  // 'urlCreator'  => function ($action, $model, $key, $index) {
                  //       return Url::to(["schedule/" . $action, "id" => $model->id]);
                  // }
                ]
            ];

 ?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterUrl' => Url::to(["schedule/index"]),
        'columns' => $colums,
        'pjax'=> true,
        'summary'=>false,
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

<?php Pjax::end(); ?>

</div>
</div>
</div>
</section>

