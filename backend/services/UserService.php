<?php

namespace backend\services;

use backend\models\user\UserFilterMD;
use common\entities\UserEntity;
use Yii;


class UserService
{
    public static function getAllUsers()
    {
        $oPermissionFilter = new UserFilterMD();
        $get = Yii::$app->request->get();

        //Получаем ID пользователей
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        foreach ($roles as $role) {
            $usersId[] = $auth->getUserIdsByRole($role->name);
        }

        $userId = array_reduce($usersId, function ($acc, $item) {
            return array_merge($acc, $item);
        }, []);

        $oQuery = UserEntity::find()->where(['in', 'id', $userId]);
        $oQuery = $oPermissionFilter->addFilterParams($oQuery);
        $oQuery = $oQuery
            ->orderBy(['username' => SORT_ASC]);
        $models = $oQuery->all();

        return $models;

    }


}