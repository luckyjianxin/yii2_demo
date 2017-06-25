<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Officecontact */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="officecontact-form">

    <?php $form = ActiveForm::begin(['id' => 'office-form']); ?>
	
	<? echo $form->field($model, 'branch')->dropDownList($branchs, ['prompt'=>'请选择门店']) ?>

    <!-- <?= $form->field($model, 'branch')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lat')->textInput(['disabled' => 'true']) ?>

    <?= $form->field($model, 'lon')->textInput(['disabled' => 'true']) ?>

	<div class="form-group">
		<label>Map</label>
		<div id="google_map" style="width: 760px; height: 400px">
			
		</div>
	</div>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$this->registerJsFile('http://maps.google.com/maps/api/js?sensor=false');

\backend\assets\GoogleMapAsset::register($this);  

// GoogleMapAsset::addPageScript($this, '');

?>



<?php $this->beginBlock('oform'); ?>
  	$(function() {
    	var zoom = 16;
    	var lat = -36.84846;
    	var lon = 174.763332;
		var address = '<?php  $model->address ?>';
    	$("#google_map").goMap({
    		scaleControl: true, 
    		maptype: 'ROADMAP', 
    		streetViewControl: false,
    		zoom: zoom,
    		markers: [{
    			id: 'address',
    			address: address,
    			latitude: lat, 
    			longitude: lon,
    			draggable: true
            }]
    	});


    	$.goMap.createListener({type:'marker', marker:'address'}, 'position_changed', function() {
    		
    		var latlon = $($.goMap.mapId).data('address').getPosition().toUrlValue();
    		var points = latlon.split(',');
    		console.log(points);
    		$("#officecontact-lat").val(points[0]);
    		$("#officecontact-lon").val(points[1]);
        });
	        


    	$("#officecontact-address").change(function() {
    		if($(this).val() == "") {
    			alert("Address is empty!")
    		} else {
    			var _address = $.goMap.createListener({type:'marker', marker:'address'}, 'position_changed', function() { 
    				$.goMap.fitBounds();
    				$.goMap.removeListener(_address);
    				$.goMap.setMap({zoom:17});
    		    });

        		$.goMap.setMarker('address', {address: $(this).val()});
    		}
    		return false;
    	});
	});



  
<?php $this->endBlock();  $this->registerJs($this->blocks['oform'], View::POS_END); ?>
