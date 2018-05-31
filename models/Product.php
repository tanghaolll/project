<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $pid
 * @property string $product
 * @property string $created_time
 * @property string $updated_time
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_time', 'updated_time'], 'safe'],
            [['product'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pid' => 'Pid',
            'product' => 'Product',
            'created_time' => 'Created Time',
            'updated_time' => 'Updated Time',
        ];
    }
}
