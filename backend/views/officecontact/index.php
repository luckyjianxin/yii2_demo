<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '门店管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="officecontact-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('门店管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加门店', ['create']) ?></li>
        </ul>


<div class="tab-content">

<?php Pjax::begin(['id' => 'offices']); ?>    
  <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'branch',
            'address',
            'lat',
            'lon',

            ['class' => '\kartik\grid\ActionColumn',
             'template' => '{update} {delete}',
             'header' => '',
             'updateOptions' => ['label' => '<span class="btn btn-success btn-xs"><i class="glyphicon glyphicon-pencil"></i></span>'],
             'deleteOptions' => ['label' => '<span class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i></span>'],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
    
</div>
</div>

</div>

<script type="text/javascript">
  $(document).ready(function(){
    // console.log($('#offices'));
  });
</script>
