<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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

<?= Html::a('Назад', ['/user'], ['class' => 'btn btn-outline-secondary']) ?>

<div class="row mt-3 ml-2">
    <ul class="nav nav-tabs">
        <?= Html::a('Главная', ['user/view', 'id' => $model->id], ['class' => 'nav-link active']) ?>
        </li>
    </ul>
</div
<div class="container-fluid">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatusTitle();
                },
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <p>
        <?= Html::a('Изменить', ['edit', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'POST',
            ],
        ]) ?>
    </p>
</div>

