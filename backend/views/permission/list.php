<?php
/* @var $this yii\web\View */
/* @var $role string*/
/* @var $aListUsers \common\entities\UserEntity*/

use yii\helpers\Html;
use yii\widgets\LinkPager;


?>

<p>
    <?= Html::a('Добавить пользователя', ['permission/create-user'], ['class' => 'btn btn-primary col-3'])?>
</p>

<div class="row">
    <div class="col-lg-12">
        <?php echo \common\components\widgets\app\PermissionUserFilter::widget(['oFilterModel' => $oFilterModel, 'role' => $aListRole, 'action'=> 'list', 'cities' => $cities]) ?>
        <div class="tab-content mt-3">
            <div class="tab-pane active" id="new">
                <div class="table-responsive">
                    <table class="table m-b-0">
                        <thead>
                        <th>Имя</th>
                        <th>Телефон</th>
                        <th>Город</th>
                        <th>Роль</th>
                        <th>Статус</th>
                        <th>Изменить роль</th>
                        </thead>
                        <tbody>
                        <?php foreach ($aListUsers as $key => $user): ?>
                            <tr>
                                <td><?= Html::a($user->name, ['staff/view', 'id' => $user->id])?></td>
                                <td><?= $user->phone ?></td>
                                <td><?= $user->getCityTitle() ?></td>
                                <td><?= $user->getRoleDescription() ?></td>
                                <td>
                                    <?php if($user->status == 10):?>
                                        <h6 class="text-success">Активен</h6>
                                    <?php else:?>
                                        <h6 class="text-danger">Заблокирован</h6>
                                    <?php endif;?>
                                </td>
                                <td><?= Html::a('<i class="fa fa-pencil"></i>', ['permission/edit-role', 'id' => $user->id, 'role' => $role], ['class' => 'btn btn-primary']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


