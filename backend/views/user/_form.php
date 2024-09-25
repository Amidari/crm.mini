<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var array $aListRole */
/** @var \backend\models\SignupForm $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card">
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'role')->dropDownList($aListRole, [
                        'class' => "form-control select-source",
                    ])
                ?>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
