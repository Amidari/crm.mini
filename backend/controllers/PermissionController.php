<?php

namespace backend\controllers;


use common\entities\events\ChangeEvent;
use common\model_data\permission\CreateRoleForm;
use backend\services\PermissionService;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class PermissionController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [

                        ],
                        'allow' => true,
                        'roles' => ['update_setting'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Вывод всех ролей
     * @return string
     */
    public function actionIndex()
    {
        $this->redirect('/permission/edit');
    }

    /**
     * Изменение прав выбранной роли
     * @return string
     */
    public function actionEdit()
    {
        $get = Yii::$app->request->get();
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($get['name']);
        $sTitle = 'Изменение прав роли: ' . $role->description;

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            PermissionService::saveChangePermission($post);
            Yii::$app->session->setFlash('success', 'Данные изменены');
        }

        $permission = PermissionService::checkPermission($get['name']);
        return $this->render('edit', [
            'sTitle' => $sTitle,
            'permission' => $permission,
        ]);
    }


}