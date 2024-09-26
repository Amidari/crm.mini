<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
///** @var common\models\User $model */
/** @var common\entities\UserEntity $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="row justify-content-center mt-3">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card">
            <div class="card-body">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>

            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

