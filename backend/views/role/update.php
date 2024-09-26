<?php

use common\models\AuthItem;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helpers\app\FormatHelper;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var common\models\AuthItem $dataProvider */
/** @var \frontend\models\PermissionForm $permission */

$script = <<< JS
$('.can_teach').css("display", "none");
if ($('#is_teacher').is(':checked')) {
        $('.can_teach').css("display", "block");
    }
$('#is_teacher').click(function(){
    if ($(this).is(':checked')) {
        $('.can_teach').css("display", "block");
    } else { 
        $('.can_teach').css("display", "none");
    }
});
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);

$this->title = $sTitle;

?>

    <div class="header">
        <h2><?= $sTitle ?></h2>
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

    <!--Управление меню-->
    <div class="row">
        <div class="col-md-4 mt-3">
            <div class="card h-100">
                <h5 class="card-header">Пункты меню</h5>
                <div class="card-body">
                            <p>Дополнительные функции</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_search" <?php if ($permission->topMenu_search) echo 'checked' ?>><span> Поиск студента</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_schedule" <?php if ($permission->topMenu_schedule) echo 'checked' ?>><span> Полное расписание</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_task_create" <?php if ($permission->topMenu_task_create) echo 'checked' ?>><span> Создать задачу</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_task_income" <?php if ($permission->topMenu_task_income) echo 'checked' ?>><span> Задачи для меня</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_task_control" <?php if ($permission->topMenu_task_control) echo 'checked' ?>><span> Контроль заданий</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_task_archive" <?php if ($permission->topMenu_task_archive) echo 'checked' ?>><span> Архив заданий</span></label>
                            </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox">
                    <label><input type="checkbox" value="true"
                                  name="topMenu_staff" <?php if ($permission->topMenu_staff) echo 'checked' ?>><span> Пользователи</span></label>
                </h5>
                <div class="card-body">
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_user_teacher" <?php if ($permission->topMenu_user_teacher) echo 'checked' ?>><span> Преподаватели</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_user_client" <?php if ($permission->topMenu_user_client) echo 'checked' ?>><span> Клиенты</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_user_other" <?php if ($permission->topMenu_user_other) echo 'checked' ?>><span> Другие сотрудники</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card h-100">
                <h5 class="card-header">Преподаватель</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div>
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox" value="true"
                                                  name="topMenu_user_teacher" <?php if ($permission->topMenu_user_teacher) echo 'checked' ?>><span> Список преподавателей</span></label>
                                </div>
                            </div>
                            <div>
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox" value="true"
                                                  name="create_teacher" <?php if ($permission->create_teacher) echo 'checked' ?>><span> Добавить учителя</span></label>
                                </div>
                            </div>
                            <div>
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox" value="true"
                                                  name="lock_teacher" <?php if ($permission->lock_teacher) echo 'checked' ?>><span> Заблокировать/разблокировать</span></label>
                                </div>
                            </div>
                            <hr>
                            <div>
                                <div class="fancy-checkbox">
                                    <label><input type="checkbox" value="true" id="is_teacher"
                                                  name="teacher_role" <?php if ($permission->teacher_role) echo 'checked' ?>><span> Статус преподаватель</span></label>
                                </div>
                            </div>
                            <div class="fancy-checkbox can_teach">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_my_classes" <?php if ($permission->topMenu_my_classes) echo 'checked' ?>><span> Мои занятия</span></label>
                            </div>
                            <div class="fancy-checkbox can_teach">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_interview" <?php if ($permission->topMenu_interview) echo 'checked' ?>><span> Собеседования</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Студетны-->
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox"><label>
                        <input type="checkbox" value="true" name="topMenu_students" <?php if ($permission->topMenu_students) echo 'checked' ?>>
                    <span> Студенты</span></label></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Пункты главного меню</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="list_my_student" <?php if ($permission->list_my_student) echo 'checked' ?>><span> Список своих студентов</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="list_all_student" <?php if ($permission->list_all_student) echo 'checked' ?>><span> Список всех студентов</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="create_student" <?php if ($permission->create_student) echo 'checked' ?>><span> Добавить студента</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="student_archive" <?php if ($permission->student_archive) echo 'checked' ?>><span> Архив студентов</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="working_off" <?php if ($permission->working_off) echo 'checked' ?>><span> Отработки</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="list_working_off_group" <?php if ($permission->list_working_off_group) echo 'checked' ?>><span> Список групп на отработки</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="archive_working_off_group" <?php if ($permission->archive_working_off_group) echo 'checked' ?>><span> Архив групп на отработки</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="full_schedule" <?php if ($permission->full_schedule) echo 'checked' ?>><span> Полное расписание</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="students_rating_level_prediction" <?php if ($permission->students_rating_level_prediction) echo 'checked' ?>><span> Прогноз уровня студентов</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Страница студента</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_news_line" <?php if ($permission->menu_news_line) echo 'checked' ?>><span> Лента событий</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_finance" <?php if ($permission->menu_finance) echo 'checked' ?>><span> Финансы</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_for_staff" <?php if ($permission->menu_for_staff) echo 'checked' ?>><span> Для сотрудников</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_magazine" <?php if ($permission->menu_magazine) echo 'checked' ?>><span> Журнал</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_progress" <?php if ($permission->menu_progress) echo 'checked' ?>><span> Прогресс</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_goal" <?php if ($permission->menu_goal) echo 'checked' ?>><span> Цели</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Информация о студентах</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="student_contact_info" <?php if ($permission->student_contact_info) echo 'checked' ?>><span> Контактная информация студента</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="student_contact_source" <?php if ($permission->student_contact_source) echo 'checked' ?>><span> Точки контакта</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="language_management" <?php if ($permission->language_management) echo 'checked' ?>><span> Управление знанием языка</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="questionnaire_action" <?php if ($permission->questionnaire_action) echo 'checked' ?>><span> Действия с анкетой</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--Действия в журнале и цели-->
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card h-100">
                <h5 class="card-header">Журнал студента</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Действия в журнале</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_add_lessons" <?php if ($permission->magazine_add_lessons) echo 'checked' ?>><span> Дополнение журнала</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_form" <?php if ($permission->magazine_form) echo 'checked' ?>><span> Формирование журнала</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_repeal_pay" <?php if ($permission->magazine_repeal_pay) echo 'checked' ?>><span> Отмена оплаты занятия</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_delete_lessons" <?php if ($permission->magazine_delete_lessons) echo 'checked' ?>><span> Удаление занятия в журнале</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_view_schedule" <?php if ($permission->magazine_view_schedule) echo 'checked' ?>><span> Просмотр расписания</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="magazine_edit_schedule" <?php if ($permission->magazine_edit_schedule) echo 'checked' ?>><span> Редактирование расписания</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="factlog_admin" <?php if ($permission->factlog_admin) echo 'checked' ?>><span> Админ. просмотр</span></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-3">
            <div class="card h-100">
                <h5 class="card-header">Цели</h5>
                <div class="card-body">
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="goals_create" <?php if ($permission->goals_create) echo 'checked' ?>><span> Добавить цель</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="goals_view" <?php if ($permission->goals_view) echo 'checked' ?>><span> Просмотр цели</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="goals_comment" <?php if ($permission->goals_comment) echo 'checked' ?>><span> Комментирование цели</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Финансы-->
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox"><label><input type="checkbox" value="true"
                                                      name="topMenu_finance" <?php if ($permission->topMenu_finance) echo 'checked' ?>><span> Финансы</span></label></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Страничка студента</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="finance_inform" <?php if ($permission->finance_inform) echo 'checked' ?>><span> Общая финансовая информация</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="financial_actions" <?php if ($permission->financial_actions) echo 'checked' ?>><span> Действия по финансам</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Главное меню - финансы</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_magazine" <?php if ($permission->topMenu_finance_magazine) echo 'checked' ?>><span> Финансовый журнал</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_debts_and_payments" <?php if ($permission->topMenu_finance_debts_and_payments) echo 'checked' ?>><span> Долги и оплаты</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_create_bonus_or_deduction_teacher" <?php if ($permission->topMenu_finance_create_bonus_or_deduction_teacher) echo 'checked' ?>><span> Добавить премию или вычет преподавателю</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_create_bonus_or_deduction_staff" <?php if ($permission->topMenu_finance_create_bonus_or_deduction_staff) echo 'checked' ?>><span> Добавить премию или вычет сотруднику</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_bonus_and_deduction_teacher" <?php if ($permission->topMenu_finance_bonus_and_deduction_teacher) echo 'checked' ?>><span> Премии и вычеты преподавателям</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_bonus_and_deduction_staff" <?php if ($permission->topMenu_finance_bonus_and_deduction_staff) echo 'checked' ?>><span> Премии и вычеты сотрудникам</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_salary_calculation" <?php if ($permission->topMenu_finance_salary_calculation) echo 'checked' ?>><span> Расчет зарплаты</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_issue_for_reporting" <?php if ($permission->topMenu_finance_issue_for_reporting) echo 'checked' ?>><span> Выдача под отчет</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_non_cash_payments" <?php if ($permission->topMenu_finance_non_cash_payments) echo 'checked' ?>><span> Безналичные платежи</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_cash_payments" <?php if ($permission->topMenu_finance_cash_payments) echo 'checked' ?>><span> Платежи наличными</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_calculation_holiday_payments" <?php if ($permission->topMenu_finance_calculation_holiday_payments) echo 'checked' ?>><span> Расчет отпускных платежей</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_finance_revenue_forecast" <?php if ($permission->topMenu_finance_revenue_forecast) echo 'checked' ?>><span> Прогноз выручки</span></label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--        Лиды-->
    <div class="row">
        <div class="col mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox"><label><input type="checkbox" value="true"
                                                      name="topMenu_lead" <?php if ($permission->topMenu_lead) echo 'checked' ?>><span> Лиды</span></label></h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <p>Пункты главного меню</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_create" <?php if ($permission->menu_lead_create) echo 'checked' ?>><span> Добавить лид</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_list" <?php if ($permission->menu_lead_list) echo 'checked' ?>><span> Список лидов</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Действия с лидами</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="lead_action_new_interview" <?php if ($permission->lead_action_new_interview) echo 'checked' ?>><span> Назначить собеседование</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="lead_action_call" <?php if ($permission->lead_action_call) echo 'checked' ?>><span> Запланировать звонок</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="lead_action_rejection" <?php if ($permission->lead_action_rejection) echo 'checked' ?>><span> Отказ</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="lead_action_create_student" <?php if ($permission->lead_action_create_student) echo 'checked' ?>><span> Создать студента</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <p>Меню списка лидов</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_new_leads" <?php if ($permission->menu_lead_new_leads) echo 'checked' ?>><span> Новые лиды</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_in_touch" <?php if ($permission->menu_lead_in_touch) echo 'checked' ?>><span> На связи</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_interview" <?php if ($permission->menu_lead_interview) echo 'checked' ?>><span> Собеседование</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_for_education" <?php if ($permission->menu_lead_for_education) echo 'checked' ?>><span> На обучение</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_archive" <?php if ($permission->menu_lead_archive) echo 'checked' ?>><span> Архив</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="menu_lead_refusal" <?php if ($permission->menu_lead_refusal) echo 'checked' ?>><span> Отказники</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    Отчеты и дополнительно-->
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox"><label><input type="checkbox" value="true"
                                                      name="topMenu_report" <?php if ($permission->topMenu_report) echo 'checked' ?>><span> Отчеты</span></label></h5>
                <div class="card-body">
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_report_finance" <?php if ($permission->topMenu_report_finance) echo 'checked' ?>><span> Финансовый отчет</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_report_student" <?php if ($permission->topMenu_report_student) echo 'checked' ?>><span> Отчет по студентам</span></label>
                    </div>
                    <div class="fancy-checkbox">
                        <label><input type="checkbox" value="true"
                                      name="topMenu_report_educability" <?php if ($permission->topMenu_report_educability) echo 'checked' ?>><span> Отчет по обучаемости</span></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card h-100">
                <h5 class="card-header fancy-checkbox"><label><input type="checkbox" value="true"
                                                                     name="topMenu_additionally" <?php if ($permission->topMenu_additionally) echo 'checked' ?>><span> Дополнительно</span></label>
                </h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <p>Подрядчитки</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_contractors" <?php if ($permission->topMenu_additionally_contractors) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="contractor_actions" <?php if ($permission->contractor_actions) echo 'checked' ?>><span> Действия</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p>Возврат студентов</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_return_students" <?php if ($permission->topMenu_additionally_return_students) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="request_student_actions" <?php if ($permission->request_student_actions) echo 'checked' ?>><span> Действия</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p>Видео</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_video" <?php if ($permission->topMenu_additionally_video) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="video_actions" <?php if ($permission->video_actions) echo 'checked' ?>><span> Действия</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p>Мероприятия</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_events" <?php if ($permission->topMenu_additionally_events) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="events_actions" <?php if ($permission->events_actions) echo 'checked' ?>><span> Действия</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p>Выполненные задания</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_completed_tasks" <?php if ($permission->topMenu_additionally_completed_tasks) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="idea_create" <?php if ($permission->idea_create) echo 'checked' ?>><span> Добавить</span></label>
                            </div>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="idea_actions" <?php if ($permission->idea_actions) echo 'checked' ?>><span> Действия</span></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <p>Журналы действий</p>
                            <div class="fancy-checkbox">
                                <label><input type="checkbox" value="true"
                                              name="topMenu_additionally_activity_log" <?php if ($permission->topMenu_additionally_activity_log) echo 'checked' ?>><span> Просмотр</span></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mt-3">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>



<?php ActiveForm::end(); ?>