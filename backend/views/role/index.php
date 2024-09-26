<?php

use yii\helpers\Html;

/** @var common\models\AuthItem $authItems */

$this->title = $sTitle;

?>
<?php if( Yii::$app->session->hasFlash('setting_success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('setting_success'); ?>
    </div>
<?php endif;?>
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
                    <h3 class="card-title">Роли</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" >
                            <?= Html::a('Добавить роль', ['role/create'], ['class' => 'btn btn-success float-right'])?>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Описание</th>
                            <th>Изменить права</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($authItems as $item): ?>
                        <tr>
                            <td><?= $item->name ?></td>
                            <td><?=Html::a($item->description, ['role/update', 'name'=>$item->name], ['class' => 'link']) ?></td>
                            <td><?= Html::a('<i class="fa fa-pencil"></i>', ['permission/edit', 'name'=>$item->name], ['class' => 'btn btn-primary']) ?></td>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


