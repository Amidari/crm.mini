<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\bootstrap5\Html;
use backend\components\widgets\NavBar;
use backend\components\widgets\MainSidebar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column">
    <?php $this->beginBody() ?>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?= NavBar::widget() ?>

        <?= MainSidebar::widget() ?>

        <div class="content-wrapper">
            <div class="container-fluid">
                <?= $content ?>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage(); ?>

