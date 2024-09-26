<?php

namespace backend\components\widgets;


use yii\base\Widget;

class UserFilter extends Widget
{
    public $oFilterModel;
    public $role;
    public $action;
    public $status = 10;
    public function run()
    {
        return $this->render('user_filter', [
            'oFilterModel' => $this->oFilterModel,
            'action' => $this->action,
            'role' => $this->role,
            'status' => $this->status,
        ]);
    }
}