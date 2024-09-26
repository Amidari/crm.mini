<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var common\models\AuthItem $dataProvider */


$this->title = $sTitle;

?>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $sTitle ?></h1>
                </div>
            </div>
        </div>
    </div>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('success'); ?>
    </div>
<?php endif; ?>

<?php $form = ActiveForm::begin([
    'id' => 'permission-form',
]); ?>
    <input name="name" value="<?= $permission->name ?>" hidden="hidden">
    <div class="container-fluid">
        <!--Управление меню-->
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card h-100">
                    <h5 class="card-header">Пункты меню</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" name="update_setting"
                                       id="update_setting" <?php if ($permission->update_setting) echo 'checked' ?>>
                                <label class="custom-control-label"
                                       for="update_setting"><span> Управление</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-1 mt-3">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-1 mt-3">
                <?=Html::a('Назад', ['/role'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


<?php ActiveForm::end(); ?>