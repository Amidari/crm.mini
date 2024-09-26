<?php

namespace backend\models\permission;


use yii\base\Model;

class RoleForm extends Model
{
    public $title;

    public function rules()
    {
        return [
            [['title'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Название роли',
        ];
    }

}