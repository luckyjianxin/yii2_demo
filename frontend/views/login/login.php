<?php
\frontend\assets\AppAsset::register($this);
\frontend\assets\LoginAsset::register($this);
$this->beginPage();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>登录 | Yii2通用后台</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <?php $this->head() ?>
        <link rel="shortcut icon" href="favicon.ico" />
        <script language="JavaScript">
            var BaseUrl = '<?=Yii::getAlias('@web')?>';
        </script>
    </head>
    <!-- END HEAD -->

    <body class=" login">
    <?php $this->beginBody() ?>
        <!-- BEGIN LOGO -->
        <div class="logo">
        </div>
        <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="<?=\yii\helpers\Url::toRoute('login/login')?>" method="post">
                <h3 class="form-title font-green">登录</h3>
                <?php if (\Yii::$app->getSession()->hasFlash('error')) {  ?>
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span><?=\Yii::$app->getSession()->getFlash('error');?> </span>
                </div>
                <?php } ?>
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Customer No.</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Customer No" name="LoginForm[cno]" /> 
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="LoginForm[password]" /> 
                </div>
                <div class="form-actions">
                    <label class="rememberme check mt-checkbox mt-checkbox-outline" style="padding-left:25px;">
                        <input type="checkbox" name="LoginForm[rememberMe]" value="1" checked/>记住我
                        <span></span>
                    </label>
                    <button type="submit" class="btn green pull-right" style="margin-top:-10px;">登录</button>
                </div>
                <div class="create-account"></div>
            </form>
            <!-- END LOGIN FORM -->
        </div>
        <div class="copyright"> <?=date('Y')?> &copy; </div>

    <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>