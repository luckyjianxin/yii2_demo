<?php
namespace backend\widgets\grid;

use backend\assets\SwitcherAsset;
use yii\grid\DataColumn;
use yii\helpers\Html;
use common\enums\BooleanEnum;
use yii\helpers\Url;
class SwitcherColumn extends  DataColumn
{
    public $reload = 0;
    public $route = ['default'];
    public function registerClientScript()
    {

        SwitcherAsset::register($this->grid->view);
        $js1 = <<<'EOT'
		    $('.js-switch').on('change', function(){
		        var switchery =  $(this).data("switchery");
                var self = this;
		        switchery.disable();
		        var url =  $(this).data("url");
		        var reload =  $(this).data("reload");
		        var checked =  $(this).is(':checked') ? '1' : '0';
		        var data = $(this).data("params");
		        data.value = checked;
		        $.post( url, data, function(response){
		            if(response.status == false){
		                $.modal.error(response.msg);
                        switchery.enable();
		            } else {
                        $.modal.success(response.msg);
                    }
		            // if(reload){
		                location.reload();
		            // }
		        });
		    });
EOT;

$js = <<<'EOT'
            // $('.switch_ck').each(function() {
            //         $(this).wrap('<div class="switch switch-small"  data-on-label="Y" data-off-label = "N" />').parent().bootstrapSwitch();
            // });      

            $(".bootstrap-switch").on("click", function() {
                alert();
            });
            return;
            $('.switch_ck').on('switch-change', function (e, data) {

                var $el = $(data.el) , value = data.value;
                var url =  $el.data("url");
                var reload =  $el.data("reload");
                var checked = value;
                var data = $el.data("params");
                data.value = checked ? 1 : 0;
                
                $.post( url, data, function(response){
                    
                    if(response.status == false){
                        $.modal.error(response.msg);
                    } else {
                        $.modal.success(response.msg);
                    }

                    
                    $.pjax.reload({container:"#schedules"});
                    $('.switch_ck').each(function() {
                        $(this).bootstrapSwitch();
                    });                    
                });
            });
EOT;


        $this->grid->view->registerJs($js,\yii\web\View::POS_READY); //因为可能会被pjax加载所以放在这里
    }
    /**
     * @inheritdoc
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        $params = is_array($key) ? $key : ['id' => (string) $key];
        $params["attribute"] = $this->attribute;
        $value = $this->getDataCellValue($model, $key, $index) ;
        if(is_string($value)) {
            $result =  $value;
        } else {
            $this->registerClientScript();
            // $result =  Html::checkbox('', $value == BooleanEnum::TRUE, [
            //     'class' => 'js-switch',
            //     'data-url' => Url::to($this->route),
            //     'data-params' => $params,
            //     'data-reload' => $this->reload,
            //     'data-toggle' => 'switcher'
            // ]);

            $options =  [
                'class' => 'switch_ck',
                'data-url' => Url::to($this->route),
                'data-params' => $params,
                'data-reload' => $this->reload,
                'data-toggle' => 'switch',
            ];        
            if ($value == BooleanEnum::TRUE) {
                $options["disabled"] = 1;
            }                  
            
            $result =  Html::checkbox('', $value == BooleanEnum::TRUE, $options);
        }
        return $result;
    }
}