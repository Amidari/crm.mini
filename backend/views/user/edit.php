<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\entities\UserEntity $model */

$this->title = 'Изменить пользователя: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<?php if (Yii::$app->session->hasFlash('setting_success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('setting_success'); ?>
    </div>
<?php endif; ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $sTitle ?></h1>
            </div>
        </div>
    </div>
</div>

<?= Html::a('Назад', ['user/view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>

<!-- Main content -->
<section class="content">
    <?= $this->render('_form-update', [
        'model' => $model,
        'aListRole' => $aListRole,
    ]) ?>
</section>


