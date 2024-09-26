<?php

namespace backend\components\widgets;

use yii\base\Widget;

class MainSidebar extends Widget
{
    public function run()
    {
        return $this->render('main-sidebar');
    }
}