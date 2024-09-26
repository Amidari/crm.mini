<?php

namespace common\entities;

use common\models\AuthAssignment;
use common\models\AuthItem;
use common\models\User;
use Yii;

class UserEntity extends User
{
    public $role;

    public function rules()
    {
        $aRules = parent::rules();
        $aNewRules[] = [['Email','role'], 'safe'];

        return array_merge($aRules, $aNewRules);
    }

    /**
     * Получаем модель пользователя
     * если $iUserID null тогда текущего
     * @param null $iUserID
     * @return UserEntity|null
     * @throws \Throwable
     */
    public static function get($iUserID = null)
    {
        if (is_null($iUserID) || empty($iUserID)) {
            $iUserID = \Yii::$app->getUser()->getIdentity()->getId();
        }

        $oUser = self::findOne($iUserID);

        return $oUser;
    }

    static function getStatus()
    {
        return [
            self::STATUS_DELETED => 'Удален',
            self::STATUS_INACTIVE => 'Не активен',
            self::STATUS_ACTIVE => 'Активен',
        ];
    }

    public function getStatusTitle()
    {
        return self::getStatus()[$this->status];
    }

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new UserEntity();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);
    }

    public function getRole()
    {
        $role = AuthAssignment::findOne(['user_id' => $this->id]);
        return $role->item_name;
    }

    public function getRoleDescription()
    {
        $role = AuthItem::findOne(['name' => $this->getRole()]);
        return $role->description;
    }

    public function editRole()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->role);

        $auth->revokeAll($this->id);

        try {
            $auth->assign($role, $this->id);
        } catch (\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }


}