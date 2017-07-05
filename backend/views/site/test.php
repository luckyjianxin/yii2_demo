<?php
use prawee\vuejs\VueJsAsset;
VueJsAsset::register($this);

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<div id="app">
<div class="container-fluid">


<div class="row">
	<div class="col-md-2">
			<!-- <form id="add_form2" action="<?= Yii::$app->urlManager->createUrl(['site/addhistory'])?>" method="POST" role="form">
				<legend>Add History</legend>
			
				<div class="form-group">
					<label for="">Subject</label>
					<input type="text" class="form-control" id="" placeholder="Subject..." name="subject">
				</div>
				<div class="form-group">
					<label for="">Content</label>
					<textarea class="form-control" rows="5" id="" placeholder="Content" name="content"></textarea>
				</div>

				<div class="form-group">
					<?= Html::label('Mail To', $for = 'mail-to', ['class' => '']); ?>
					<?= Html::input('text', 'mail_to', '', ['class' => 'form-control']); ?>
				</div>
				<button type="submit" class="btn btn-primary" id="save" >Submit</button>
			</form> -->

			<?php $form = ActiveForm::begin(['id' => 'add_form', 'action' => Url::toRoute(['site/addhistory'])]); ?>

				<div class="form-group">
		     		<?= $form->field($model, 'enquiry_id')->textInput(['class' => 'form-control']); ?>
				</div>
				<div class="form-group">
		     		<?= $form->field($model, 'customer_id')->textInput(['class' => 'form-control']); ?>
				</div>
				<div class="form-group">
		     		<?= $form->field($model, 'subject')->textInput(['class' => 'form-control']); ?>
				</div>
				<div class="form-group">
		     		<?= $form->field($model, 'content')->textarea(['class' => 'form-control']); ?>
				</div>
				<div class="form-group">
		     		<?= $form->field($model, 'mail_to')->textInput(['class' => 'form-control']); ?>
				</div>

		    <div class="form-group">
		        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		    </div>

		    <?php ActiveForm::end(); ?>

			
	</div>
	<div class="col-md-10 table-responsive">
		<table class="table table-bordered table-hover ">
			<thead>
				<tr>
					<th>ID</th>
					<th>To</th>
					<th>SUBJECT</th>
					<!-- <th>CONTENT</th> -->
					<th>Create Date</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="histories">
			</tbody>
		</table>
	</div>
</div>
	
</div>
</div>

<script id="historytmpl" type="text/x-dot-template">
{{ if(it.length != 0) { }}
	 {{ for (var i = 0, l = it.length; i < l; i++) { }}
	  <tr>
		<td>{{= it[i].id }}</td>
		<td>{{= it[i].mail_to }}</td>
		<td>{{= it[i].subject }}</td>
		<!-- <td>{{= it[i].content }}</td> -->
		<td>{{= it[i].create_at }}</td>
		<td>
			<button type="button" class="btn btn-danger btn-xs remove_history" onClick="removeHistory('{{= it[i].id }}')"><span class="glyphicon glyphicon-remove" ></span></button>
		</td>
	  </tr>
	 {{ } }}
{{ } else { }}
<tr><td colspan="5">暂无数据</td></tr>
{{ } }}
</script>

<script type="text/javascript">
 //    var csrfToken = '<?= Yii::$app->request->csrfToken ?>';
	// $.ajax({
 //        type:'POST',
 //        url : '<?= Yii::$app->urlManager->createUrl(['site/test'])?>',
 //        data: {_csrf: csrfToken},
 //        dataType: 'json',
 //        beforeSend: function() {
 //        	$("#histories").html('<tr><td colspan="3"><span class="progress-bar-success label-success">正在加载...</span></td></tr>');
 //        },
 //        success: function(data){
 //        	var obj = data;
 //            var tmpl = $("#historytmpl").text();//document.getElementById('historytmpl').innerHTML;
	// 		var doTtmpl = doT.template(tmpl);
	// 		$("#histories").html(doTtmpl(obj));
 //        }
 //    });


$(function() {
	var app = new Vue({
	  el: '#app',
	  data: {
	  	message: '',
	    data: []
	  },
	  created() {
	  	this.fetch();
	  },
	  methods: {
	  	fetch() {
	  		var self = this;
	  		var csrfToken = '<?= Yii::$app->request->csrfToken ?>';
			$.ajax({
		        type:'POST',
		        url : '<?= Yii::$app->urlManager->createUrl(['site/test'])?>',
		        data: {_csrf: csrfToken},
		        dataType: 'json',
		        beforeSend: function() {
		        	$("#histories").html('<tr><td colspan="5"><span class="progress-bar-success label-success">正在加载...</span></td></tr>');
		        },
		        success: function(result){
		        	self.data = result;
		        	var obj = result;
		            var tmpl = $("#historytmpl").text();//document.getElementById('historytmpl').innerHTML;
					var doTtmpl = doT.template(tmpl);
					$("#histories").html(doTtmpl(obj));
		        }
		    });
	  	},
	  	add() {
	  		
	  	},
	  	show() {
	  		// this.data = [];
	  		var self = this;
	  		var tmpl = $("#historytmpl").text();//document.getElementById('historytmpl').innerHTML;
			var doTtmpl = doT.template(tmpl);
			$("#histories").html(doTtmpl(self.data));
	  	}
	  }
	});


	$('form#add_form').on('beforeSubmit', function(e) {
		var $form = $(this);
        if ($form.find('.has-error').length) 
        {
            return false;
        }
        $.ajax({
            url: $form.attr('action'),
            type: 'post',
            data: $form.serialize(),
            success: function (data) {
            	$(':input','#add_form')  
				 .not(':button, :submit, :reset, :hidden')  
				 .val('')  
				 .removeAttr('checked')  
				 .removeAttr('selected');  

                if (data.status) {
					toastr.success(data.success);
					var tmpl = $("#historytmpl").text();//document.getElementById('historytmpl').innerHTML;
					var doTtmpl = doT.template(tmpl);
					$("#histories").html(doTtmpl(data.data));
                } else {
                	toastr.error(data.error);
                }
            }
        });
        return false;

	}).on('submit', function (e) {
    	e.preventDefault();
    });
  
});

function removeHistory(id) {
	$.post('<?= Url::toRoute(['site/removehistory'])?>', {id: id, _csrf: '<?= Yii::$app->request->csrfToken ?>'})
  		.then(function(data){
		    if (data.status) {
					toastr.success(data.success);
					var tmpl = $("#historytmpl").text();//document.getElementById('historytmpl').innerHTML;
					var doTtmpl = doT.template(tmpl);
					$("#histories").html(doTtmpl(data.data));
                } else {
                	toastr.error(data.error);
                }
		});
}

</script>
