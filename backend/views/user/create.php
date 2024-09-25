<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\SignupForm $model */

$this->title = 'Создание пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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


    <?= $this->render('_form', [
        'model' => $model,
        'aListRole' => $aListRole,
    ]) ?>
    </div>

