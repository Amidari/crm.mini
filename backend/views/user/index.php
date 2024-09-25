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
                        <div class="col-md-10">
                            <?= UserFilter::widget(['oFilterModel' => $oFilterModel, 'role' => $aListRole]) ?>
                        </div>
                        <div class="col-md-2 align-content-center mt-3">

                                <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>

                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Статус</th>
                            <th>Роль</th>
                            <th>Управление</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($aListUsers as $user): ?>
                            <tr>
                                <td><?= $user->id ?></td>
                                <td><?=$user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->getStatusTitle() ?></td>
                                <td><?= $user->getRoleDescription() ?></td>
                                <td><?= Html::a('<i class="fa fa-pencil"></i>', ['user/view', 'id'=>$user->id], ['class' => 'btn btn-primary']) ?></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

