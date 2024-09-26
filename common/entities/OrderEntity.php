<?php

namespace common\entities;

use common\models\Order;
use Yii;

class OrderEntity extends Order
{

    public function getProducts()
    {
        $this->hasMany(ProductEntity::className(), ['order_id' => 'id'])->viaTable('order_product', ['order_id' => 'id']);
    }
}