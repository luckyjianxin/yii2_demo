<?php
use yii\helpers\Url;

//print_r(Yii::app());
//echo Yii::$app->request->getUrl(); 
$url = Yii::$app->request->getUrl();
$active1 = ($url == "/" || $url == '/index/index') ? 'active' : '';
$active2 = ($url == '/scene/index') ? 'active' : '';
$active3 = ($url == '/summary/index') ? 'active' : '';
$active4 = ($url == '/note/index') ? 'active' : '';
?>
<div class="hor-menu">
    <ul class="nav navbar-nav">
        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
        <li class="classic-menu-dropdown <?=$active1?>">
            <a href="<?=Url::toRoute('/')?>">Home <span class="selected"></span></a>
        </li>

        <li class="classic-menu-dropdown <?=$active2?>">
            <a href="<?=URL::toRoute('scene/index')?>">Scene </a>
        </li>

        <li class="classic-menu-dropdown <?=$active3?>">
            <a href="<?=URL::toRoute('summary/index')?>">Summary </a>
        </li>

        <li class="classic-menu-dropdown <?=$active4?>">
            <a href="<?=URL::toRoute('note/index')?>">Note </a>
        </li>


<!--         <?php if(!empty($allMenu['main']) && is_array($allMenu['main'])):?>
        <?php foreach ($allMenu['main'] as $menu): ?>
        <li class="classic-menu-dropdown <?php if (isset($menu['class'])) {echo 'active';} ?>">
            <a href="<?=\yii\helpers\Url::toRoute($menu['url'])?>">
                <?=$menu['title']?>
                <?php if (isset($menu['class'])) {echo '<span class="selected"></span>';} ?>
            </a>
        </li>
        <?php endforeach; ?>
        <?php endif; ?> -->
        
<!--         <li class="classic-menu-dropdown">
            <a href="javascript:;" data-hover="megamenu-dropdown" data-close-others="true"> 
                其他
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu pull-left">
                <li>
                    <a href="javascript:;"><i class="fa fa-bookmark-o"></i> 测试其他 </a>
                </li>
            </ul>
        </li> -->
    </ul>
</div>
