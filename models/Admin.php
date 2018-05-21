<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property int $id 主键
 * @property string $username 用户名
 * @property string $password 登录密码
 * @property string $nickname 昵称
 * @property string $avatar 头像
 * @property string $mobile 手机号码
 * @property string $email 电子邮箱
 * @property int $status 状态（0：禁用、1：启用）
 * @property int $last_login_time 最近登录时间
 * @property int $last_login_ip 最近登录IP
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Admin extends ActiveRecord
{

    const STATUS_DISABLED = 0;
    const STATUS_ENABLED = 1;

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    public function rules()
    {
        return [
            [['username'], 'unique'],
            [['username', 'password'], 'required'],
            [['email'], 'email'],
            [['status', 'last_login_time', 'last_login_ip', 'created_at', 'updated_at'], 'integer'],
            [['username', 'nickname'], 'string', 'max' => 32],
            [['password', 'avatar'], 'string', 'max' => 128],
            [['mobile'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 64],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'username' => '用户名',
            'password' => '登录密码',
            'nickname' => '昵称',
            'avatar' => '头像',
            'mobile' => '手机号码',
            'email' => '电子邮箱',
            'status' => '状态',   //（0：禁用、1：启用）
            'last_login_time' => '最近登录时间',
            'last_login_ip' => '最近登录IP',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->isNewRecord ? $this->password = md5($this->password) : '';
            return true;
        }
        return false;
    }


    public static function tableName()
    {
        return '{{%admin}}';
    }

    public static function find()
    {
        return new AdminQuery(get_called_class());
    }
}
