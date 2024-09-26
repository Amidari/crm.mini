<?php

/** @var common\models\AuthItem $dataProvider */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = $sTitle;

?>
<?php if( Yii::$app->session->hasFlash('setting_success') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('setting_success'); ?>
    </div>
<?php endif;?>

    <div class="header">
        <h2><?= $sTitle?></h2>
    </div>

<?php $form = ActiveForm::begin([
    'id' => 'create-others-form'
]); ?>

<div class="row clearfix">
    <div class="col-lg-6 col-md-12">
        <div>
            <?= $form->field($oModel, 'title', ['template' =>
                '{label}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="icon-user"></i></span>
                            </div>
                            {input}
                        </div>
                        {error}',])
                ->textInput([
                    'class' => 'form-control',
                    'autocomplete' => 'off'
                ]);
            ?>
        </div>
</div>

<div class="col-12">
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

