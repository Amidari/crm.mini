<?php

namespace common\entities;

use common\models\Order;
use Yii;

class OrderEntity extends Order
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заявка',
            'description' => 'Описание',
            'client_name' => 'Клиент',
            'client_phone' => 'Номер телефона',
            'status' => 'Статус заявки',
            'created_at' => 'Дата создания',
            'product' => 'Продукт',
            'price' => 'Цена'
        ];
    }

    public function getProducts()
    {
        $this->hasMany(ProductEntity::className(), ['order_id' => 'id'])->viaTable('order_product', ['order_id' => 'id']);
    }
}