<?php

/** @var common\models\AuthItem $dataProvider
 * @var \common\model_data\permission\CreateRoleForm $model
 * */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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


<?php $form = ActiveForm::begin([
    'id' => 'create-roles-form'
]); ?>

<div class="container-fluid ml-2">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-body">
                        <?= $form->field($model, 'title', ['template' =>
                            '{label}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            {input}
                        </div>
                        {error}',])
                            ->textInput([
                                'class' => 'form-control',
                                'autocomplete' => 'off'
                            ]);
                        ?>

                    <div class="input-group mb-3">
                        <div class="form-group">
                            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

