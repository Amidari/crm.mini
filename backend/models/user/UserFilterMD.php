<?php

namespace backend\models\user;

use yii\base\Model;
use yii\db\ActiveQuery;

class UserFilterMD extends Model
{
    public $name;
    public $role;
    public $status = 10;

    public function rules()
    {
        return [
            [['name', 'role', 'status'], 'safe'],
            [['name'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'role' => 'Роль',
            'status' => 'Статус'
        ];
    }


    /**
     * @param ActiveQuery $oQuery
     * @return mixed
     */
    public function addFilterParams($oQuery)
    {
        if ($this->load(\Yii::$app->request->get())) {
            if ($this->name) {
                $oQuery->andwhere(['like', 'username', $this->name]);
            }
        }
        //Применять фильтр по статусу вне зависимости от наличия параметров get
        if ($this->status){
            $oQuery->andWhere(['IN', 'status', $this->status]);
        }

        return $oQuery;
    }

}