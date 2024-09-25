<?php

namespace backend\components\widgets;

use yii\base\Widget;

class MainSidebar extends Widget
{
    public function run()
    {

        $sidebar = WebMenu::getLeftMenu();

        return $this->render('main-sidebar', compact('sidebar'));
    }
}