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
        

$js = <<<'JS'
            $(".bootstrap-switch").on('switchChange.bootstrapSwitch', function (event,state) {  
                console.log(state); 
                var url =  $(this).find('.switch_ck').data("url");
                var data = $(this).find('.switch_ck').data("params");
                data.value = state ? 1 : 0; 
                console.log(data);
                $.post( url, data, function(response){
                    if(response.status == false){
                        $.modal.error(response.msg);
                    } else {
                        $.modal.success(response.msg);
                    }
                    
                    location.reload();
                    // $.pjax.reload({container:"#schedules"});
                    // $('.switch_ck').each(function() {
                    //     $(this).bootstrapSwitch();
                    // });                    
                });
            });              
JS;


        $this->grid->view->registerJs($js); //因为可能会被pjax加载所以放在这里
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