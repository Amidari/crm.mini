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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'client_name' => 'Client Name',
            'client_phone' => 'Client Phone',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
