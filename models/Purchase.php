<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "purchase".
 *
 * @property int $oid
 * @property string $sin_num
 * @property string $type
 * @property string $customer
 * @property int $number
 * @property int $price
 * @property int $total_price
 * @property string $invoice
 * @property string $created_time
 * @property string $updated_time
 */
class Purchase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sin_num'], 'required'],
            [['number', 'price', 'total_price'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['sin_num'], 'string', 'max' => 200],
            [['type', 'customer', 'invoice'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'oid' => 'Oid',
            'sin_num' => 'Sin Num',
            'type' => 'Type',
            'customer' => 'Customer',
            'number' => 'Number',
            'price' => 'Price',
            'total_price' => 'Total Price',
            'invoice' => 'Invoice',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}
