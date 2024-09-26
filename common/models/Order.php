<?php


namespace common\models;
/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $client_name
 * @property string $client_phone
 * @property string $status
 * @property string $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_REJECTED = 2;
    const STATUS_DEFECT = 3;

    public $product_price;
    public $product_title;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'client_name', 'client_phone', 'status', 'created_at'], 'required'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['title', 'client_name', 'client_phone'], 'string', 'max' => 255],
            [['status'],'integer'],
        ];
    }

    public function getProduct(){
        $product = Product::find()
            ->select('product.title as title, product.price as price')
            ->join('join', 'order_product', 'order_product.product_id = product.id')
            ->join('join', 'order', 'order.id = order_product.order_id')
            ->where(['order.id' => $this->id])
            ->one();
        return $product;
    }

    static function getStatus()
    {
        return [
            self::STATUS_NEW => 'Новый заказ',
            self::STATUS_ACCEPTED => 'Принята',
            self::STATUS_REJECTED => 'Отказана',
            self::STATUS_DEFECT => 'Брак',
        ];
    }

    public function getStatusTitle()
    {
        return self::getStatus()[$this->status];
    }
}
