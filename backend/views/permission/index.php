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

<p>
    <?= Html::a('Добавить роль', ['permission/create-role'], ['class' => 'btn btn-primary col-3'])?>
</p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'description',
        [
            'class' => ActionColumn::className(),
            'template' => '{update}',
            'urlCreator' => function ($action, AuthItem $model, $key, $index, $column) {
                return Url::toRoute([$action, 'name' => $model->name]);
            }
        ],
    ],
]); ?>

