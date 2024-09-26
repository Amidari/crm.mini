<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240925_194803_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
        ]);

        $this->insert('product', ['title' => 'Яблоки', 'price' => 150]);
        $this->insert('product', ['title' => 'Груши', 'price' => 200]);
        $this->insert('product', ['title' => 'Lamborghini', 'price' => 300000]);

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
