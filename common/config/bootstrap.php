<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

/* 设置 url 别名 */
Yii::setAlias('@backendUrl', env('BACKEND_URL')); //后台url
Yii::setAlias('@frontendUrl', env('FRONTEND_URL')); //前台url
