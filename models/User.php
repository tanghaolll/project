<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $uid 管理员id
 * @property string $login_name 用户名
 * @property string $mobile 手机号码
 * @property string $login_pwd 密码
 * @property int $user_type 用户类型1管理员2用户
 * @property int $status 1有效2无效
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 插入时间
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_type', 'status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['login_name'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 20],
            [['login_pwd'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'login_name' => 'Login Name',
            'mobile' => 'Mobile',
            'login_pwd' => 'Login Pwd',
            'user_type' => 'User Type',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
