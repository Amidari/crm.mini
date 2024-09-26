<?php

namespace backend\controllers;

use common\entities\OrderEntity;
use common\models\Order;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class OrderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $sTitle = 'Заявки';
        return $this->render('index', [
            'sTitle' => $sTitle,
            'orders' => OrderEntity::find()->all(),
        ]);
    }

    public function actionView()
    {
        $sTitle = 'Просмотр заявки';
        $model = OrderEntity::find()->where(['id' => Yii::$app->request->get('id')])->one();

        return $this->render('view', [
            'sTitle' => $sTitle,
            'model' => $model,
        ]);
    }

    public function actionDelete(){
        $model = OrderEntity::find()->where(['id' => Yii::$app->request->get('id')])->one();
        $model->delete();
        return $this->redirect(['/order']);
    }

    public function actionEdit(){
        $sTitle = 'Изменение заявки';
        $model = OrderEntity::find()->where(['id' => Yii::$app->request->get('id')])->one();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            return $this->redirect(['/order']);
        }

        return $this->render('edit', [
            'sTitle' => $sTitle,
            'model' => $model,
        ]);
    }



}
