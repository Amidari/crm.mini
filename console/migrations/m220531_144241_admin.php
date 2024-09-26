<?php

use yii\db\Migration;

/**
 * Class m220531_144241_admin
 */
class m220531_144241_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $user = \Yii::createObject([
            'class'    => common\models\User::className(),
            'scenario' => 'create',
            'username'    => 'admin',
            'email' => 'admin@example.com',
            'password' => '123',
            'auth_key' =>''
        ]);
        if (!$user->insert(false)) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220531_144241_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220531_144241_admin cannot be reverted.\n";

        return false;
    }
    */
}
