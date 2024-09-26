<?php

namespace backend\services;

use backend\models\permission\PermissionForm;
use common\models\AuthItemChild;
use frontend\models\PermissionEditForm;
use Yii;
use yii\base\Exception;


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
        $permission->update_setting = in_array('update_setting', $item);

        return $permission;

    }

    /**
     * @throws Exception
     */
    public static function saveChangePermission($change)
    {
        self::deletePermission($change['name']);
        self::savePermission($change);
    }

    /**
     * Сохранение новых прав
     * @param $change
     * @return void
     */
    protected static function savePermission($change)
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($change['name']);
        $permission = $auth->getPermissions();
        $allPermission = self::getAllPermission();
        for ($i = 0; $i < count($allPermission); $i++) {
            if (isset($change[$allPermission[$i]]) && $change[$allPermission[$i]] == 'on') {
                $auth->addChild($role, $permission[$allPermission[$i]]);
            }
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
            for ($i = 0; $i < count($allPermission); $i++) {
                if ($authItemChild->child == $allPermission[$i]) $auth->removeChild($role, $permission[$allPermission[$i]]);
            }
        }
    }

    public static function getAllPermission(): array
    {
        $auth = Yii::$app->authManager;
        $oPermissions = $auth->getPermissions();
        foreach ($oPermissions as $item) {
            $permission[] = $item->name;
        }
        return $permission;
    }

}