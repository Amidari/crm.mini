<?php

namespace backend\components\widgets;

use Yii;

class WebMenu
{
    public static function getLeftMenu():array
    {
        return [
            [
                'label' =>'<i class="far fa-circle nav-icon"></i>Главная',
                'url' => ['/'],
                'options' => ['class' => 'nav-item'],
                'active' => Yii::$app->requestedRoute == 'site/index',
            ],
            [
                'label' => '<i class="far fa-circle nav-icon"></i>MCRM коробки',
                'url' => ['/mcrm-box'],
                'options' => ['class' => 'nav-item'],
                'active' => Yii::$app->requestedRoute ==  'service/index',
            ],
            [
                'label' => '<i class="far fa-circle nav-icon"></i>Управление серверами',
                'url' => ['/server'],
                'options' => ['class' => 'nav-item'],
                'active' => Yii::$app->requestedRoute ==  'server/index',
            ],
            [
                'label' => '<i class="far fa-circle nav-icon"></i>Управление пользователями',
                'url' => ['/user'],
                'options' => ['class' => 'nav-item'],
                'active' => Yii::$app->requestedRoute == 'user/index',
            ],
        ];
    }
}