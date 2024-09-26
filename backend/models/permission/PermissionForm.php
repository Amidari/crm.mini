<?php

namespace backend\models\permission;

use backend\services\PermissionService;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class PermissionForm extends Model
{
    public $name;
    public $update_setting;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $permission = PermissionService::getAllPermission();
        return [
            [['name'], 'safe'],
            [$permission]];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'verifyCode' => 'Verification Code',
        ];
    }

}
