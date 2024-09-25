<?php

namespace backend\controllers;

use backend\models\SignupForm;
use common\entities\ServerEntity;
use common\entities\UserEntity;
use common\models\server\ServersUsers;
use backend\models\user\UserFilterMD;
use backend\services\PermissionService;
use backend\components\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sTitle = 'Пользователи';

        //Создаем модель формы фильра и подгружаем данные из GET
        $oFilterModel = new UserFilterMD();
        $oFilterModel->load(Yii::$app->request->get());

        //Подгружаем список пользователей
        $aListUsers = PermissionService::getAllUsers();
        $aListRole = PermissionService::getRoleList();

        return $this->render('index', [
            'sTitle' => $sTitle,
            'aListUsers' => $aListUsers,
            'aListRole' => $aListRole,
            'oFilterModel' => $oFilterModel,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        $sTitle = 'Пользователь: '. $model->username;

        return $this->render('view', [
            'model' => $model,
            'sTitle' => $sTitle,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $sTitle = 'Создание пользователя';

        $model = new SignupForm();
        $aListRole = PermissionService::getRoleList();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())&&$model->signup()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'sTitle' => $sTitle,
            'aListRole' => $aListRole,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        $sTitle = 'Пользователь: '. $model->username;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $model->editRole();
            return $this->redirect(['index']);
        }

        $aListRole = PermissionService::getRoleList();
        return $this->render('edit', [
            'sTitle' => $sTitle,
            'model' => $model,
            'aListRole' => $aListRole,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found

     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserEntity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserEntity::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
