<?php
\frontend\assets\HomeAsset::register($this);


$cid = 3269;

$wd = '25/06/2018';
$info = new stdClass();

$info->culturals = Yii::$app->db1->createCommand('select * from ns_iculture order by name asc ')->queryAll();

?>
<div class="container">
<!--customer Information-->
  <div class="row">
      <!-- <div class="col-md-2"></div> -->
      <div class="col-md-12  col-xs-12" style="padding: 0px;">
        <div class="col-md-8 col-xs-12">
          <div class="col-md-12 col-xs-12">
            <h3 class="home_title">Customer Information:</h3>
          </div>
        </div>
        <div class="col-md-4 col-xs-12 text-right">
           <div class="col-md-12 col-xs-12">
               <h3 class="c_title0"><?php echo ($from == 'Enq') ? 'Enquiry NO' : 'Customer NO' ?>: <?php echo '01234';//MiscUtils::customerId($info->order->customerId); ?></h3>
           </div>
        </div>
        <div class="col-md-12 col-xs-12 headline1_div">&nbsp;</div>
      </div>
      <!-- <div class="col-md-2"></div> -->
  </div>
  <div class="row" id="customer_info">
    <!-- <div class="col-md-2"></div> -->
    <div class="col-md-12 col-xs-12 background_info_div paddingTop30">
        <div class="col-md-6">
          <div class="form-group text-left border-bottom marginBottom30">
            <span class="c_title1">Wedding date: <?php echo $wd;?></span>
          </div>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-6">
          <div class="form-group text-left">
            <label for="bride_name" class="c_title2">Bride Name:</label>
            <input id="bride_name" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->bridename; ?>"></input>
          </div>
          <div class="form-group text-left">
            <label for="bride_email" class="c_title2">Email:</label>
            <input id="bride_email" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->brideemail; ?>"></input>         
          </div>
          <div class="form-group text-left">
            <label for="bride_mobile" class="c_title2">Phone:</label>
            <input id="bride_mobile" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->bridemobile; ?>"></input>
          </div>
         
        </div>
        <div class="col-md-6">
          <div class="form-group text-left">
            <label for="groom_name" class="c_title2">Groom Name:</label>
            <input id="groom_name" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->groomname; ?>"></input>
          </div>
          <div class="form-group text-left">
            <label for="groom_email" class="c_title2">Email:</label>
            <input id="groom_email" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->groomemail; ?>"></input>         
          </div>
          <div class="form-group text-left">
            <label for="groom_mobile" class="c_title2">Phone:</label>
            <input id="groom_mobile" disabled="disabled" class="form-control input_text" value="<?php echo $info->order->groommobile; ?>"></input>
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="form-group text-left">
            <label for="cultural_background" class="c_title2">Cultural Background</label>
            <select id="cultural_background" disabled="disabled" class="form-control select_text" >
               <option value=""></option>
               <?php foreach ($info->culturals as &$cul) { 
               ?>
                 <option value="<?php echo $cul->name; ?>" <?php echo ($cul->name == $info->order->culture) ? "selected='selected'" : ""; ?> ><?php echo $cul->name; ?></option>
               <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-12">
          <div class="form-group text-left ">
            <label for="cultural_background2" class="c_title2">Second Cultural Background: (if your partner is different cultural background)</label>
            <select id="cultural_background2" disabled="disabled" class="form-control select_text " >
               <option value=""></option>
               <?php foreach ($info->culturals as &$cul) { 
               ?>
                 <option value="<?php echo $cul->name; ?>" <?php echo ($cul->name == $info->order->culture2) ? "selected='selected'" : ""; ?> ><?php echo $cul->name; ?></option>
               <?php } ?>
            </select>
          </div>
        </div>

        <?php if ($type != 'Client') { ?>
        <div class="col-md-12 col-xs-12 padding20_30">
          <div class="col-md-6 col-xs-6 text-left button_padding_0">
             <img id="edit1_btn" style="cursor: pointer;" src="<?=Yii::getAlias('images/edit_btn.png')?>"></img>
             <img id="cancel1_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('images/cancel_btn.png')?>"></img>
          </div>
          <div class="col-md-6 col-xs-6 text-right button_padding_0">
             <img id="confirm1_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('images/confirm_btn.png')?>"></img>
          </div>
        </div>
        <?php } else { ?>
            <div class="col-md-12 col-xs-12 padding20_30"></div>
        <?php  } ?>

        <div class="col-md-12 sperate20_div">&nbsp;</div>
    </div>
<!--     <div class="col-md-2"></div>
 -->  </div>
</div>


<?php \frontend\assets\AboutAsset::register($this);?>
<!-- BEGIN CARDS -->
<div class="row margin-top-15">
    <div class="col-lg-3 col-md-6">
        <div class="portlet light">
            <div class="card-icon">
                <i class="icon-user-follow font-red-sunglo theme-font"></i>
            </div>
            <div class="card-title">
                <span> 最佳的用户体验 </span>
            </div>
            <div class="card-desc">
                <span> 这个是卡片效果的，网站推广的产品链接，热门用户及文章链接等都可以在这里显示。 </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="portlet light">
            <div class="card-icon">
                <i class="icon-trophy font-green-haze theme-font"></i>
            </div>
            <div class="card-title">
                <span> 其他卡片效果 </span>
            </div>
            <div class="card-desc">
                <span> 这个是卡片效果的，网站推广的产品链接，热门用户及文章链接等都可以在这里显示。 </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="portlet light">
            <div class="card-icon">
                <i class="icon-basket font-purple-wisteria theme-font"></i>
            </div>
            <div class="card-title">
                <span> 网上商城模块 </span>
            </div>
            <div class="card-desc">
                <span> 这个是卡片效果的，网站推广的产品链接，热门用户及文章链接等都可以在这里显示。 </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="portlet light">
            <div class="card-icon">
                <i class="icon-layers font-blue theme-font"></i>
            </div>
            <div class="card-title">
                <span> 自适应组件 </span>
            </div>
            <div class="card-desc">
                <span> 这个是卡片效果的，网站推广的产品链接，热门用户及文章链接等都可以在这里显示。 </span>
            </div>
        </div>
    </div>
</div>
<!-- END CARDS -->



<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
    $(function(){
        
    });
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>