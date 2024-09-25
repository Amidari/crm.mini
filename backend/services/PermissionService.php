<?php

namespace backend\services;

use common\entities\UserEntity;
use common\models\AuthItemChild;
use common\models\permission\PermissionForm;
use backend\models\user\UserFilterMD;
use frontend\models\PermissionEditForm;
use Yii;


class PermissionService
{
    public static function getRoleList()
    {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles();
        foreach ($roles as $role) {
            $roleName[$role->name] = $role->description;
        }
        return $roleName;
    }

    public static function checkPermission($name)
    {
        $itemChild = AuthItemChild::find()->where(['parent' => $name])->all();
        $item = [];
        foreach ($itemChild as $child) {
            $item[] = $child->child;
        }
        $permission = new PermissionForm;
        $permission->name = $name;
        $permission->menu_settings = in_array('menu_settings', $item);

        return $permission;

    }

    public static function saveChangePermission($change)
    {

        self::deletePermission($change['name']);
        self::savePermission($change);

    }

    /**
     * Сохранение новых прав
     * @param $change
     * @return void
     * @throws \yii\base\Exception
     */
    protected static function savePermission($change)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($change['name']);
        $permission = $auth->getPermissions();
        $allPermission = self::getAllPermission();
        for ($i = 0; $i <= count($allPermission); $i++) {
            if ($change[$allPermission[$i]]) $auth->addChild($role, $permission[$allPermission[$i]]);
        }

    }

    /**
     * Удаление всех прав
     * @param $name
     * @return void
     */
    protected static function deletePermission($name)
    {
        $allPermission = self::getAllPermission();

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($name);
        $permission = $auth->getPermissionsByRole($name);
        $authItemChilds = AuthItemChild::find()->where(['parent' => $name])->all();

        foreach ($authItemChilds as $authItemChild) {
            for ($i = 0; $i <= count($allPermission); $i++) {
                if ($authItemChild->child == $allPermission[$i]) $auth->removeChild($role, $permission[$allPermission[$i]]);
            }
        }
    }

    public static function getUsersByRole($name)
    {
        $auth = Yii::$app->authManager;
        $userId = $auth->getUserIdsByRole($name);

        return UserEntity::find()->where(['in', 'id', $userId])->orderBy('name')->all();
    }

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

        //Сортировка по фильтру
//        if ($get['UserFilterMD']['role'] != null) {
//            foreach ($models as $key => $model) {
//                if ($model->getRole()!= $get['UserFilterMD']['role']) {
//                    unset($models[$key]);
//                }
//            }
//        }

        return $models;

    }

    public static function getPermissionEditForm($userId)
    {
        $user = UserEntity::findOne(['id' => $userId]);

        $model = new PermissionEditForm();
        $model->id = $user->id;
        $model->name = $user->name;
        $model->phone = $user->phone;
        $model->city = $user->getCityTitle();
        $model->role = '';

        return $model;

    }

    public static function savePermissionUser($id, $role)
    {
        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);
        $permission = $auth->getRole($role);
        $auth->assign($permission, $id);
    }

    protected static function getAllPermission()
    {
        return [
            'menu_settings',
        ];

    }

}