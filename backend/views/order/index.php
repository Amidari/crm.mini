<?php

use common\entities\UserEntity;
use backend\components\widgets\UserFilter;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var  UserEntity $aListUsers */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $sTitle?></h1>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Клиент</th>
                            <th>Заявка</th>
                            <th>Товар</th>
                            <th>Телефон</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Комментарий</th>
                            <th>Цена</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?=$order->client_name ?></td>
                                <td><?=$order->title ?></td>
<!--                                Вывести товар-->
                                <td><?=$order->getProduct()->title ?></td>
                                <td><?=$order->client_phone ?></td>
                                <td><?=$order->created_at ?></td>
<!--                                Вывести статус-->
                                <td><?=$order->getStatusTitle() ?></td>
                                <td><?=$order->description ?></td>
                                <td><?=$order->getProduct()->price ?></td>
                                <td><?= Html::a('<i class="fa fa-pencil"></i>', ['order/view', 'id'=>$order->id], ['class' => 'btn btn-primary']) ?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

