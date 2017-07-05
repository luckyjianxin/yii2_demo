<?php
\frontend\assets\HomeAsset::register($this);
use common\helpers\MyUtils;

$session = Yii::$app->session;
$customer = $session->get('_customer');
print_r($customer);

$cookies = Yii::$app->request->cookies;
$value = json_decode($cookies->get('_customer')); 

// var_dump($cookies);

// print_r(($value));

// $cid = 3269;
// $oid = 3507;

// $wd = '25/06/2018';
// $sql = "select t.e_oid as id, t.customerId, t.date, t.assistant_name, t.assistant_phone, t1.bridename, t1.brideemail,t1.bridephone,t1.bridemobile,t1.groomname, t1.groomphone,t1.groommobile,t1.groomemail,t1.culture,t1.culture2 from ns_v1myorder as t left join ns_v1customer as t1 on t1.e_oid = t.customerId where t.e_oid = {$oid} and t.customerId={$cid}";
// $info->order = Yii::$app->db1->createCommand($sql)->queryAll();


?>

<style type="text/css">
  .page-content {
    background: #fff;
  }
</style>

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
               <h3 class="c_title0"><?php echo ($from == 'Enq') ? 'Enquiry NO' : 'Customer NO' ?>: <?php echo MyUtils::customerId($order->customerId); ?></h3>
           </div>
        </div>
        <div class="col-md-12 col-xs-12 headline1_div">&nbsp;</div>
      </div>
      <!-- <div class="col-md-2"></div> -->
  </div>
  <div class="row" id="customer_info">
    <!-- <div class="col-md-2"></div> -->
    <div class="col-md-12 col-xs-12 background_info_div paddingTop30">
        <div class="col-md-6 col-xs-12">
          <div class="form-group text-left border-bottom marginBottom30">
            <span class="c_title1">Wedding date: <?php echo date('d/m/Y', $order->date);?></span>
          </div>
        </div>
        <div class="col-md-12"></div>
        <div class="col-md-6 col-xs-12">
          <div class="form-group text-left">
            <label for="bride_name" class="c_title2">Bride Name:</label>
            <input id="bride_name" disabled="disabled" class="form-control input_text" value="<?php echo $order->bridename; ?>"></input>
          </div>
          <div class="form-group text-left">
            <label for="bride_email" class="c_title2">Email:</label>
            <input id="bride_email" disabled="disabled" class="form-control input_text" value="<?php echo $order->brideemail; ?>"></input>         
          </div>
          <div class="form-group text-left">
            <label for="bride_mobile" class="c_title2">Phone:</label>
            <input id="bride_mobile" disabled="disabled" class="form-control input_text" value="<?php echo $order->bridemobile; ?>"></input>
          </div>
         
        </div>
        <div class="col-md-6 col-xs-12">
          <div class="form-group text-left">
            <label for="groom_name" class="c_title2">Groom Name:</label>
            <input id="groom_name" disabled="disabled" class="form-control input_text" value="<?php echo $order->groomname; ?>"></input>
          </div>
          <div class="form-group text-left">
            <label for="groom_email" class="c_title2">Email:</label>
            <input id="groom_email" disabled="disabled" class="form-control input_text" value="<?php echo $order->groomemail; ?>"></input>         
          </div>
          <div class="form-group text-left">
            <label for="groom_mobile" class="c_title2">Phone:</label>
            <input id="groom_mobile" disabled="disabled" class="form-control input_text" value="<?php echo $order->groommobile; ?>"></input>
          </div>
        </div>
        
        <div class="col-md-12  col-xs-12">
          <div class="form-group text-left">
            <label for="cultural_background" class="c_title2">Cultural Background</label>
            <select id="cultural_background" disabled="disabled" class="form-control select_text" >
               <option value=""></option>
               <?php foreach ($culturals as &$cul) { 
               ?>
                 <option value="<?=$cul['name']; ?>" <?php echo ($cul['name'] == $order->culture) ? "selected='selected'" : ""; ?> ><?=$cul['name']; ?></option>
               <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group text-left ">
            <label for="cultural_background2" class="c_title2">Second Cultural Background: (if your partner is different cultural background)</label>
            <select id="cultural_background2" disabled="disabled" class="form-control select_text " >
               <option value=""></option>
               <?php foreach ($culturals as &$cul) { 
               ?>
                 <option value="<?=$cul['name']; ?>" <?php echo ($cul['name'] == $order->culture2) ? "selected='selected'" : ""; ?> ><?=$cul['name']; ?></option>
               <?php } ?>
            </select>
          </div>
        </div>

        <?php if (Yii::$app->user->identity->type != 'Client') { ?>
        <div class="col-md-12 col-xs-12 padding20_30">
          <div class="col-md-6 col-xs-6 text-left button_padding_0">
             <img id="edit1_btn" style="cursor: pointer;" src="<?=Yii::getAlias('/images/edit_btn.png')?>"></img>
             <img id="cancel1_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('/images/cancel_btn.png')?>"></img>
          </div>
          <div class="col-md-6 col-xs-6 text-right button_padding_0">
             <img id="confirm1_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('/images/confirm_btn.png')?>"></img>
          </div>
        </div>
        <?php } else { ?>
            <div class="col-md-12 col-xs-12 padding20_30"></div>
        <?php  } ?>

        <div class="col-md-12 sperate20_div">&nbsp;</div>
    </div>
<!--     <div class="col-md-2"></div>
 -->  
 </div>

  <div class="row sperate30_div">&nbsp;</div>

  <div class="row" >
    <div class="col-md-12 col-xs-12" style="padding: 0px;">
      <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12"><h1 class="home_title">Wedding Day Information:</h1></div>
      </div>
      <div class="col-md-12 headline1_div">&nbsp;</div>
    </div>
  </div>
  <div class="row" id="wedding_day_info">
    <div class="col-md-12 col-xs-12 background_info_div paddingTop30">
      <div class="col-md-12 col-xs-12">
        <div class="form-group text-left">
          <label for="contact_name" class="c_title2">Emergency Contact person: <span style="color: #ff0000">(must be reachable at all the time)</span></label>
          <input id="contact_name" class="form-control input_text" value="<?php echo $contact->em_contact_name; ?>" disabled="disabled" ></input>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="contact_phone" class="c_title2">Phone</label>
          <input id="contact_phone" class="form-control input_text" value="<?php echo $contact->em_contact_phone; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="bridesmaids_num" class="c_title2">Number of Bridesmaids:</label>
          <input id="bridesmaids_num" onfocus="if (value==0) { value=''}" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"  class="form-control input_text" value="<?php echo $contact->bridesmaids; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="flowergirls_num" class="c_title2">Number of Flower Girls:</label>
          <input id="flowergirls_num" onfocus="if (value==0) { value=''}" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"  class="form-control input_text" value="<?php echo $contact->flowergirls; ?>" disabled="disabled"></input>          
        </div>
        <div class="form-group text-left">
          <label for="guest_num" class="c_title2">Number of Guest:</label>
          <input id="guest_num" onfocus="if (value==0) { value=''}" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"  class="form-control input_text" value="<?php echo $contact->guest; ?>" disabled="disabled"></input>
        </div>
       
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="groomsman_num" class="c_title2">Number of Groomsman:</label>
          <input id="groomsman_num" onfocus="if (value==0) { value=''}" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"  class="form-control input_text" value="<?php echo $contact->groomsman; ?>" disabled="disabled"></input>          
        </div>
        <div class="form-group text-left">
          <label for="ringbearers_num" class="c_title2">Number of Page Boy's / Ring Bearer's:</label>
          <input id="ringbearers_num" onfocus="if (value==0) { value=''}" onkeyup="value=value.replace(/[^\d]/g,'')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"  class="form-control input_text" value="<?php echo $contact->ringbearers; ?>" disabled="disabled"></input>
        </div>
      </div>

      <?php if (Yii::$app->user->identity->type != 'Client') { ?>
      <div class="col-md-12 col-xs-12 padding20_30">
        <div class="col-md-6 col-xs-6 text-left button_padding_0">
           <img id="edit2_btn" style="cursor: pointer;" src="<?=Yii::getAlias('/images/edit_btn.png')?>"></img>
           <img id="cancel2_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('/images/cancel_btn.png')?>"></img>
        </div>
        <div class="col-md-6 col-xs-6 text-right button_padding_0">
           <img id="confirm2_btn" style="cursor: pointer; display: none;" src="<?=Yii::getAlias('/images/confirm_btn.png')?>"></img>
        </div>
      </div>
      <?php } else { ?>
        <div class="col-md-12 col-xs-12 padding20_30"></div>
      <?php } ?>
      <div class="col-md-12 sperate20_div">&nbsp;</div>
    </div>
  </div>
  
  <div class="row sperate30_div">&nbsp;</div>

  <div class="row">
    <div class="col-md-12 col-xs-12" style="padding: 0px;">
      <div class="col-md-12 col-xs-12">
        <div class="col-md-12 col-xs-12"><h1 class="home_title">Crew Information:</h1></div>
      </div>
      <div class="col-md-12 headline1_div">&nbsp;</div>
    </div>
  </div>
  <div class="row" id="crew_info">
    <div class="col-md-12 col-xs-12 background_info_div paddingTop30">
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="photographer1_name" class="c_title2 color_4479ff">DOP:</label>
          <input id="photographer1_name" class="form-control input_text" value="<?php echo $info->photographer1->name; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="photographer1_email" class="c_title2">Email:</label>
          <input id="photographer1_email" class="form-control input_text" value="<?php echo $info->photographer1->email; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="photographer1_phone" class="c_title2">Phone:</label>
          <input id="photographer1_phone" class="form-control input_text" value="<?php echo $info->photographer1->phone; ?>" disabled="disabled"></input>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="photographer2_name" class="c_title2 color_4479ff">2nd Photographer:</label>
          <input id="photographer2_name" class="form-control input_text" value="<?php echo $info->photographer2->name; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="photographer2_email" class="c_title2">Email:</label>
          <input id="photographer2_email" class="form-control input_text" value="<?php echo $info->photographer2->email; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="photographer2_phone" class="c_title2">Phone:</label>
          <input id="photographer2_phone" class="form-control input_text" value="<?php echo $info->photographer2->phone; ?>" disabled="disabled"></input>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 ">&nbsp;</div>

      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="videographer1_name" class="c_title2 color_ffa944"> Cinematographer / Lead Cinematographer:</label>
          <input id="videographer1_name" class="form-control input_text" value="<?php echo $info->videographer1->name; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="videographer1_email" class="c_title2">Email:</label>
          <input id="videographer1_email" class="form-control input_text" value="<?php echo $info->videographer1->email; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="videographer1_phone" class="c_title2">Phone:</label>
          <input id="videographer1_phone" class="form-control input_text" value="<?php echo $info->videographer1->phone; ?>" disabled="disabled"></input>
        </div>
      </div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="videographer2_name" class="c_title2 color_ffa944">2nd Cinematographer:</label>
          <input id="videographer2_name" class="form-control input_text" value="<?php echo $info->videographer2->name; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="videographer2_email" class="c_title2">Email:</label>
          <input id="videographer2_email" class="form-control input_text" value="<?php echo $info->videographer2->email; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="videographer2_phone" class="c_title2">Phone:</label>
          <input id="videographer2_phone" class="form-control input_text" value="<?php echo $info->videographer2->phone; ?>" disabled="disabled"></input>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 ">&nbsp;</div>
      <div class="col-md-6 col-xs-12">
        <div class="form-group text-left">
          <label for="assistant_name" class="c_title2 color_fd44ff">Assistant:</label>
          <input id="assistant_name" class="form-control input_text" value="<?php echo $info->assistant->name; ?>" disabled="disabled"></input>
        </div>
        <div class="form-group text-left">
          <label for="assistant_phone" class="c_title2">Phone:</label>
          <input id="assistant_phone" class="form-control input_text" value="<?php echo $info->assistant->phone; ?>" disabled="disabled"></input>
        </div>
      </div>
      <div class="col-md-12 col-xs-12 sperate30_div">&nbsp;</div>

    </div>
  </div>

<?php
\frontend\assets\IcheckAsset::register($this);
?>
<!--Facebook Information-->
  <div class="paddingTop50">&nbsp;</div>
   
  <div id="facebook_info" class="row"><!--row begin-->
      <div class="col-md-12 col-xs-12 c_title4 paddingTop20 background_info_div">
        <div class="col-md-9 col-sm-9 text-left">Does Dreamlife have permission to share your wedding images via face book?  If yes please supply your Face Book address details</div>
        <div class="col-md-3 col-sm-3 text-center" >
           <label class="icheckbox" style="font-weight: 400; padding-left: 4px">Yes <input type="checkbox" name="facebook_ck" id="yes_checkbox" <?php echo (($contact->is_facebook_share == 1) ? 'checked' : '') ?> <?php echo ((Yii::$app->user->identity->type == 'Client') ? 'disabled' : '') ?> >
                <span for="yes_checkbox" ></span>
          </label>
          <label class="icheckbox" style="font-weight: 400; padding-left: 4px">No <input type="checkbox" name="facebook_ck" id="no_checkbox" <?php echo (($contact->is_facebook_share == 0) ? 'checked' : '') ?>  <?php echo ((Yii::$app->user->identity->type == 'Client') ? 'disabled' : '') ?>>
               <span for="no_checkbox" ></span>
          </label>
          
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 sperate20_div">&nbsp;</div>
        <div class="col-md-6 col-sm-6 col-xs-12" id="facebook_name_div">
           <div class="form-group text-left">
              <label for="bridefacebook" class="c_title2">Bride:</label>
              <input type="text" class="form-control input_text" id="bridefacebook" value="<?php echo $contact->bridefacebook; ?>" <?php echo ((Yii::$app->user->identity->type == 'Client') ? 'disabled' : '') ?>>
            </div>
            <div class="form-group text-left">
              <label for="groomfacebook" class="c_title2">Groom:</label>
              <input type="text" class="form-control input_text" id="groomfacebook" value="<?php echo $contact->groomfacebook; ?>" <?php echo ((Yii::$app->user->identity->type == 'Client') ? 'disabled' : '') ?>>
            </div>
        </div>
        <div class="col-md-12 sperate20_div">&nbsp;</div>

        <div class="col-md-12 col-xs-12">
          <div class="form-group text-left">
              <label for="note" class="c_title2">Note:</label>  
              <textarea class="form-control input_textarea" rows="2" id="note" <?php echo ((Yii::$app->user->identity->type == 'Client') ? 'disabled' : '') ?> ><?php echo $contact->note; ?></textarea>
            </div>
        </div>
        
        
        <div class="col-md-12 col-xs-12 padding20_30">
        <?php if (Yii::$app->user->identity->type != 'Client') { ?>
          <div class="text-left button_padding_0">
             <img id="save_btn" style="cursor: pointer;" src="<?=Yii::getAlias('/images/save_btn.png')?>"></img>
          </div>
           <?php } ?>
        </div>
       

      </div>
  </div><!--row-->

  <div class="row">
    <div class="col-md-12 col-xs-12 button_padding_0">
      <div class="col-md-12 paddingTop30">&nbsp;</div>
      <div class="col-md-12 col-xs-12 text-right ">
        <img src="<?=Yii::getAlias('/images/next_btn.png')?>" alt="next" id="next_btn" style="cursor: pointer;" ></img>
      </div>
    </div>
  </div> 

</div>



<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>
    $(function(){
        $("input[name='facebook_ck']").iCheck({
          checkboxClass: 'icheckbox_minimal',
          radioClass: 'iradio_minimal',
          increaseArea: '20%' // optional
        });
    });
<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>