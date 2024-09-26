<?php

namespace backend\controllers;


use backend\models\permission\RoleForm;
use common\entities\AuthItemEntity;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;

class RoleController extends Controller
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
        $sTitle = 'Настройки ролей';

        $authItems = AuthItemEntity::find()->where(['type'=>1])->all();

        return $this->render('index', [
            'sTitle' => $sTitle,
            'authItems' => $authItems,
        ]);
    }

    /**
     * Изменение описания роли
     * @return string
     * @throws Exception
     */
    public function actionUpdate()
    {
        $get = Yii::$app->request->get();

        $sTitle = 'Изменение роли: ' . $get['name'];

        $model = new RoleForm();
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($get['name']);
        $model->title = $role->description;

        $oRequest = \Yii::$app->getRequest();
        if ($oRequest->isPost && $model->load($oRequest->post())) {
            $role = AuthItemEntity::findOne(['name' => $get['name']]);
            $role->description = $model->title;
            $role->save();
            $this->redirect(['role/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'sTitle' => $sTitle,
        ]);
    }

    /**
     * Создание новой роли
     * @return string
     * @throws \Exception
     */
    public function actionCreate()
    {

        $sTitle = "Добавить роль";

        $model = new RoleForm();

        $oRequest = \Yii::$app->getRequest();

        if ($oRequest->isPost && $model->load($oRequest->post())) {

            $auth = Yii::$app->authManager;
            $newRole = $auth->createRole($model->title);
            $newRole->description = $model->title;
            $auth->add($newRole);
            $this->redirect(['permission/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'sTitle' => $sTitle,
        ]);

    }
}