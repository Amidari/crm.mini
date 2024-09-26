<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\widgets\app\TeacherPhoto;

/* @var $this yii\web\View */
/* @var $model common\model_data\teacher\TeacherFormMD */
/* @var $aListSchool common\services\SchoolService */
/* @var $form ActiveForm */

$script = <<< JS
$('.mobile-phone-number').inputmask('+7 (999) 999-99-99', { placeholder: '+7 (___) ___-__-__' });
$('.date').inputmask('dd.mm.yyyy', { placeholder: '__.__.____' });
$('.select-source').chosen({
    //inherit_select_classes: true,
});
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);

$this->title = isset($sTitle) ? $sTitle : "";
?>

<div class="header">
    <h2><?= $sTitle ?></h2>
</div>

<?php $form = ActiveForm::begin([
    'id' => 'create-user-form',
    'enableAjaxValidation' => true,
]); ?>
<div class="card">
    <h5 class="card-header">Данные пользователя</h5>
    <div class="card-body">
        <div class="row clearfix">
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($model, 'name', ['template' =>
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
                            ]);
                        ?>

                        <div class="row clearfix">
                            <div class="col-6">
                                <?= $form->field($model, 'avatar_image', ['template' =>
                                    '{label}
                                <div class="custom-file">
                                    {input}
                                    <label class="custom-file-label">Выбрать файл</label>
                                </div>
                                {error}',])
                                    ->fileInput([
                                        'class' => 'custom-file-input',
                                        'placeholder' => ''
                                    ]);
                                ?>
                            </div>
                            <div class="col-6">
                                <img src="<?= TeacherPhoto::widget(['teacherId' => $model->teacher_id]) ?>"
                                     style="width: 69px;"/>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($model, 'city_id')
                            ->dropDownList($aListCity, [
                                'class' => "form-control",
                            ])
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'phone', ['template' =>
                            '{label}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-mobile-phone"></i></span>
                                    </div>
                                    {input}
                                </div>
                                {error}',])
                            ->textInput([
                                'class' => 'form-control mobile-phone-number',
                                'placeholder' => ''
                            ]);
                        ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'email', ['template' =>
                            '{label}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-at"></i></span>
                                </div>
                                {input}
                            </div>
                            {error}',])
                            ->textInput([
                            ]);
                        ?>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <?= $form->field($model, 'birth_date', ['template' =>
                                    '{label}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-calendar"></i></span>
                                    </div>
                                    {input}
                                </div>
                                {error}',])
                                    ->textInput([
                                        'class' => 'form-control date',
                                        'placeholder' => ''
                                    ]);
                                ?>
                            </div>
                            <div class="col-6">
                                <?= $form->field($model, 'is_female')
                                    ->radioList([0 => 'Мужской', 1 => 'Женский'], [
                                        'item' => function ($index, $label, $name, $checked, $value) {
                                            $checked = ($checked == 1) ? "checked" : "";
                                            $return = '<label class="fancy-radio custom-color-green">';
                                            $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" ' . $checked . '>';
                                            $return .= '<span><i></i>' . ucwords($label) . '</span>';
                                            $return .= '</label>';
                                            return $return;
                                        }
                                    ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?= $form->field($model, 'address', ['template' =>
                            '{label}
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-map"></i></span>
                        </div>
                        {input}
                    </div>
                    {error}',])
                            ->textInput([
                                'class' => 'form-control',
                                'placeholder' => ''
                            ]);
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <?= $form->field($model, 'comment')
                    ->textarea([
                        'class' => 'form-control comment-area'
                    ]);
                ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    <div class="col-12">
                            <?= $form->field($model, 'schools')
                                ->dropDownList($aListSchool, [
                                    'class' => "form-control select-source",
                                    'multiple' => "multiple",
                                    'data-placeholder' => "Выбрать...",
                                ])
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h5 class="card-header"></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <?= $form->field($model, 'role')->dropDownList(
                    $aRole,
                    ['prompt' => 'Назначить роль']) ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row clearfix">
                    <div class="col-6">
                        <?= $form->field($model, 'password', ['template' =>
                            '{label}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                                    </div>
                                    {input}
                                </div>
                                {error}',])
                            ->passwordInput([]);
                        ?>
                    </div>
                    <div class="col-6">
                        <?= $form->field($model, 'password_repeat', ['template' =>
                            '{label}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                {input}
                            </div>
                            {error}',])
                            ->passwordInput([]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<div class="col-lg-12 col-md-12">-->
<!--    <div class="row clearfix">-->
<!--        <div class="col-6">-->
<!--            <br>-->
<!--            --><?php //= $form
//                ->field($model, 'can_interview', [
//                    'options' => ['class' => 'form-group clearfix'],
//                    'template' => '<label class="fancy-checkbox element-left">{input}<span>Может проводить собеседования</span></label>',
//                ])
//                ->checkbox([
//                    'labelOptions' => ['class' => 'fancy-checkbox element-left'],
//                ], false);
//            ?>
<!--        </div>-->
<!---->
<!--        <div class="col-6">-->
<!--            <br>-->
<!--            --><?php //= $form
//                ->field($model, 'can_set_goal', [
//                    'options' => ['class' => 'form-group clearfix'],
//                    'template' => '<label class="fancy-checkbox element-left">{input}<span>Может делать комментарии</span></label>',
//                ])
//                ->checkbox([
//                    'labelOptions' => ['class' => 'fancy-checkbox element-left'],
//                ], false);
//            ?>
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="row clearfix">-->
<!--        <div class="col-6">-->
<!--            <br>-->
<!--            --><?php //= $form
//                ->field($model, 'view_all_students', [
//                    'options' => ['class' => 'form-group clearfix'],
//                    'template' => '<label class="fancy-checkbox element-left">{input}<span>Видит всех студентов</span></label>',
//                ])
//                ->checkbox([
//                    'labelOptions' => ['class' => 'fancy-checkbox element-left'],
//                ], false);
//            ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<div class="col-12">
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
