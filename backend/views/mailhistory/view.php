<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\helpers\MyUtils;

/* @var $this yii\web\View */
/* @var $model common\models\Mailhistory */

$this->title = '查看记录';
$this->params['breadcrumbs'][] = ['label' => 'Mail Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mailhistory-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('邮件发送历史', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('查看记录', ['create']) ?></li>
        </ul>

    <div class="tab-content">
    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-striped table-bordered detail-view'],
        'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>', 
        'attributes' => [
            'id',
            ['attribute' => 'enquiry_id',
             'label' => 'Enquiry #',
             'value' => function($model) {
                return ($model->enquiry_id != 0) ? MyUtils::customerId($model->enquiry_id) : 0;
             }
            ],
            ['attribute' => 'customer_id',
             'value' => function($model) {
                return ($model->customer_id != 0) ? MyUtils::customerId($model->customer_id) : 0;
             }
            ],
            ['attribute' => 'type',
             'value' => function($model) {
                return ($model->type == 1) ? 'Normal' : 'Bank Transfer';
             },
            ],
            'mail_from',
            'mail_to',
            'subject',
            ['attribute' => 'content',
             'format' => 'html',
            ],
            'attachements',
            'operator',
            'info',
            'create_at',
        ],
    ]) ?>
    </div>
  </div>

    <p>
                <?= Html::button('Back', ['id' => 'back_btn', 'class' => 'btn btn-normal']) ?>

    </p>

</div>



<?php $this->beginBlock('history-view'); ?>

    $(document).ready(function() {
        $('#back_btn').click(function() {
            history.go(-1);
        });
    });
    
<?php $this->endBlock();  $this->registerJs($this->blocks['history-view'], \Yii\web\View::POS_END); ?>
