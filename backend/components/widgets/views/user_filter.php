<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div aria-labelledby="headingOne">

    <?php $form = ActiveForm::begin([
        'id' => 'user-filter-form',
        //'enableAjaxValidation' => true,
        'method' => 'get',
        'action' => '/user/',
    ]); ?>
    <div class="row clearfix">
        <div class="col-4">
            <?= $form->field($oFilterModel, 'name', ['template' =>
                '{label}
                            <div class="input-group">                         
                                {input}
                            </div>
                            {error}',])
                ->textInput([
                    'class' => 'form-control',
                ]);
            ?>
        </div>
        <div class="col-3">
            <?= $form->field($oFilterModel, 'role', ['template' =>
                '{label}
                                <div class="input-group">                                    
                                    {input}
                                </div>
                                {error}',])
                ->dropDownList($role, [
                    'class' => "form-control select-source",
                    'prompt' => "Все",
                ])
            ?>
        </div>
        <div class="col-3">
            <?= $form->field($oFilterModel, 'status', ['template' =>
                '{label}
                                <div class="input-group">                                    
                                    {input}
                                </div>
                                {error}',])
                ->dropDownList(
                    ['10' => 'Активный', '9' => 'Не активный', '0' => 'Удален'], [
                    'class' => "form-control",
                ])
            ?>
        </div>
        <div class="col-2 align-content-center mt-3">
            <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end() ?>
</div>

