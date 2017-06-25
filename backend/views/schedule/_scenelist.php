<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Schedule */
/* @var $form yii\widgets\ActiveForm */

?>

<?=Html::cssFile('@web/css/schedulescene.css')?>

<div class="container-fluid">
	<div class="row btngroup">
		<div class="col-md-12 col-xs-12 btn-group-md">
	    	<button type="button" class="btn btn-success" id="add_scene_btn" data-pid="<?=$model->id?>" >Add Scene</button>
		    <button type="button" class="btn btn-primary" id="add_travel_btn" data-pid="<?=$model->id?>">Add Travel</button>
		</div>
	</div>
	<div class="row">
	   <div class="container">

		<div class="col-md-12 col-sm-12 col-xs-12">
          <div id="scenes_show_div" >
            <ul class="sortable-list sortable" id="sort_ul" style="padding-top: 30px;">
			    <?php foreach ($scenes as $key => $value) {
			    	if ($value['type'] == 0) {
			    ?>
			     
			     <li class="sortable-item sortable_scene1" style="height: 100px; margin-bottom: 30px; position: relative; cursor: move" id="<?=($value['id']); ?>">
			     	<div class="col-md-6 col-xs-12">
			     		<input type="text" name="name" id="scenename_<?=$value['id'] ?>" class="form-control scenename" data-id="<?=($value['id']); ?>" data-attribute="name"  value="<?=$value['name'] ?>" required="required" pattern="" title="" data-id='<?=$value['id']; ?>' ></input>
			     	</div>

			     	<div class="del_btn" data-id="<?=($value['id']); ?>" style="position: absolute;right:-10px;top:-10px; cursor: pointer;">
						<?=HTML::img('@web/statics/img/del.png')?>
			     	</div>
			     </li>

			     <?php if ($value['show_traveltime'] == 1) { ?>
					<li class="ui-disabled sortable-item sortable_travel1" style="height: 70px; margin-bottom: 30px; position: relative;" id="st_<?=($value['id']); ?>">
		
						<div class="row">
							<div class="col-md-12 col-xs-12">
							  <label class="travel_time_title">
							  	<span>Travel time from</span>
							  	<span style="text-decoration: underline;"><?=($value['name']); ?></span>
							  	<span> to </span>
							  	<span id="travel_to_<?=($value['id']); ?>" class="travel_to" data-id="<?=($value['id']); ?>" data-attribute="travel_to"  data-value="<?=($value['travel_to']); ?>"  style="text-decoration: underline; cursor: pointer;"><?=($value['travel_to']); ?></span>
							  </label>
							</div>
						</div>
						<div class="del_btn" data-id="<?=($value['id']); ?>"  data-show="<?=($value['show_traveltime']); ?>" style="position: absolute;right:-10px;top:-10px; cursor: pointer;">
							<?=HTML::img('@web/statics/img/del.png')?>
				     	</div>
				     </li>	
				<?php } ?>
			     <?php } else { ?>
					<li class="sortable-item sortable_travel1" style="height: 70px; margin-bottom: 30px; position: relative; cursor: move" id="<?=($value['id']); ?>">
		
						<div class="row">
							<div class="col-md-12 col-xs-12">
							  <label class="travel_time_title">
							  	<span>Travel time from</span>
							  	<span id="travel_to_<?=($value['id']); ?>" class="travel_from" data-id="<?=($value['id']); ?>" data-attribute="travel_from" data-value="<?=($value['travel_from']); ?>" style="text-decoration: underline; cursor: pointer;"><?=($value['travel_from']); ?></span>
							  	<span> to </span>
							  	<span id="travel_to_<?=($value['id']); ?>" class="travel_to" data-id="<?=($value['id']); ?>" data-attribute="travel_to" data-value="<?=($value['travel_to']); ?>"  style="text-decoration: underline; cursor: pointer;"><?=($value['travel_to']); ?></span>
							  </label>
							</div>
						</div>
						
						<div class="del_btn" data-id="<?=($value['id']); ?>" style="position: absolute;right:-10px;top:-10px; cursor: pointer;">
							<?=HTML::img('@web/statics/img/del.png')?>
				     	</div>
				     </li>	


			     <?php } ?>

			  <?php } ?>
			</ul>
			</div>
          </div>
        </div>
	</div>
	</div>
</div>

<input type="hidden" name="" id="scene_travel_delete_url" class="form-control" value="<?=URL::toRoute(['scenedelete'])?>">
<input type="hidden" name="" id="scene_travel_add_url" class="form-control" value="<?=URL::toRoute(['sceneadd'])?>">
<input type="hidden" name="" id="changesort" class="form-control" value="<?=URL::toRoute(['changesort'])?>">

<div class="modal fade" id="travelTimeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog" >
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" 
                 data-dismiss="modal" aria-hidden="true">
                    &times;
              </button>
              <h4 class="modal-title" id="myModalLabel">
                 Change Travel Time
              </h4>
           </div>
           <div class="modal-body">
              <div class="form-group">
                <label>Travel <span id="travel_title"></span></label>
                <input type="text" class="form-control" id="travel_time_changed" />
                <input type="hidden" id="travel_id" />
                <input type="hidden" id="travel_attribute" />
                <input type="hidden" id="travel_update_url" value="<?=URL::toRoute('updatetravel');?>">
              </div>
           </div>
           <div class="modal-footer">
              <button type="button" id="cancel_btn" class="btn btn-default" 
                 data-dismiss="modal">Cancel
              </button>
              <button type="button" id="save_btn" class="btn btn-primary">
                OK
              </button>
           </div>
        </div>
    </div>
  </div>


<script>
<?PHP $this->beginBlock('js_end') ?> 
    $(".sortable").sortable({
        cursor: "move",
        items: "li:not(.ui-disabled)", //只是Li可以拖动
        containment: ".container-fluid",
        opacity: 0.7, //拖动时，透明度为0.6
        revert: true, //释放时，增加动画
        start: function(event, ui ) {
			$("#st_" + ui.item.attr('id')).hide();
        },
        update: function(event, ui) { //更新排序之后
            var ids = $(this).sortable("toArray").toString();
            var $this = $(this);
            var url = $("#changesort").val();
            var data = {ids: ids};
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    if(response.status == false){
		                $.modal.error(response.msg);
		            } else {
		                $.modal.success(response.msg);
		            }

		            location.reload();
                }
            });
        }
    });
    $(".sortable").disableSelection();



    $(window).load(function(){
      $('.sortable').mousedown(function(){
            document.activeElement.blur();
      });
  });

    $('#add_scene_btn').click(function() {
		var data = { schedule_id: $(this).data('pid'), 
              name: 'New Scene',
              type: 0,
              show_traveltime: 1,
              travel_from: 'Next Scene',
              travel_to: 'Next Location',
              order: 0
        }
        var url = $('#scene_travel_add_url').val();
		$.post(url, data, function(response){
            if(response.status == false){
                $.modal.error(response.msg);
            } else {
                $.modal.success(response.msg);
            }
            
            location.reload();                 
        });	
	});

	$('#add_travel_btn').click(function() {
		var data = { schedule_id: $(this).data('pid'), 
              name: '',
              type: 1,
              show_traveltime: 1,
              travel_from: 'Next Scene',
              travel_to: 'Next Location',
              order: 0
        }
        var url = $('#scene_travel_add_url').val();
		$.post(url, data, function(response){
            if(response.status == false){
                $.modal.error(response.msg);
            } else {
                $.modal.success(response.msg);
            }
            
            location.reload();                 
        });	
	});


			
  	$('.scenename').change(function() {  
	    console.log($(this).data('id'));
	    var data = { id: $(this).data('id'),
					 attribute: $(this).data('attribute'),
					 value: $(this).val()
				   };
		var url = $('#travel_update_url').val();
		$.post(url, data, function(response){
			$('#travelTimeModal').modal('hide');
            if(response.status == false){
                $.modal.error(response.msg);
            } else {
                $.modal.success(response.msg);
            }
            
            location.reload();                 
        });	
	});

	$('.travel_to').click(function() {  
	    var id = $(this).data('id');
	    var attr = $(this).data('attribute');
	    var value = $(this).data('value');
	    $('#travel_title').html('To');
	    $('#travel_id').val(id);
	    $('#travel_attribute').val(attr);
	    $('#travel_time_changed').val(value);
	    $('#travelTimeModal').modal('show');
	});
	$('.travel_from').click(function() {  
	    var id = $(this).data('id');
	    var attr = $(this).data('attribute');
	    var value = $(this).data('value');
	    $('#travel_title').html('From');
	    $('#travel_id').val(id);
	    $('#travel_attribute').val(attr);
	    $('#travel_time_changed').val(value);
	    $('#travelTimeModal').modal('show');
	});
	
	$('#travelTimeModal #save_btn').click(function() {
		var data = { id: $('#travel_id').val(),
					 attribute: $('#travel_attribute').val(),
					 value: $('#travel_time_changed').val()
				   }
		var url = $('#travel_update_url').val();
		$.post(url, data, function(response){
			$('#travelTimeModal').modal('hide');
            if(response.status == false){
                $.modal.error(response.msg);
            } else {
                $.modal.success(response.msg);
            }
            
            location.reload();
                                
        });		   
	});

	$('.del_btn').click(function() {  
		var show = ($(this).data('show')) ? 0 : 1;
	   var data = { id: $(this).data('id'), 'show_traveltime' : show };
		var url = $('#scene_travel_delete_url').val();
		$.post(url, data, function(response){
            if(response.status == false){
                $.modal.error(response.msg);
            } else {
                $.modal.success(response.msg);
            }
            
            location.reload();
        });
	});
<?php $this->endBlock() ?>
</script>

<?php $this->registerJs($this->blocks['js_end'],\yii\web\View::POS_END); ?>


