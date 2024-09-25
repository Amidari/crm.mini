<?php

namespace backend\components\widgets;

use yii\base\Widget;

class NavBar extends Widget
{
    public function run()
    {
        return $this->render('nav-bar');
    }
}