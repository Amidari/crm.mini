<?php

namespace frontend\models;

use common\entities\OrderEntity;
use common\entities\ProductEntity;
use common\models\OrderProduct;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OrderForm extends Model
{
    public $name;
    public $phone_number;
    public $comment;
    public $products = [];


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'phone_number', 'comment', 'products'], 'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone_number' => 'Телефон',
            'comment' => 'Комментарий',
            'products' => 'Продукты'
        ];
    }

    public function getProducts()
    {
        $productEntity = ProductEntity::find()->all();

        foreach ($productEntity as $product) {
            $products[$product->id] = $product->title;
        }
        return $products;
    }

    public function saveOrder()
    {
        $productEntity = ProductEntity::find()->where(['id' => $this->products])->one();
        $order = new OrderEntity();
        $order->title = "Заявка на " . $productEntity->title;
        $order->description = $this->comment;
        $order->client_name = $this->name;
        $order->client_phone = $this->phone_number;
        $order->status = OrderEntity::STATUS_NEW;
        $order->created_at = date("Y-m-d H:i:s");

            if($order->save()){
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $productEntity->id;
                return $orderProduct->save();

            } else {
                var_dump($order->getErrors());
            }





    }
}
