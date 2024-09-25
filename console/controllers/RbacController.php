<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $updateSetting = $auth->createPermission('update_setting');
        $updateSetting->description = 'Управление сайтом';
        $auth->add($updateSetting);


        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $auth->add($manager);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);
        $auth->addChild($admin, $updateSetting);

        $auth->assign($admin, 1);
    }
}