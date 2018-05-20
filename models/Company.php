<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property int $id ID
 * @property string $name 名称
 * @property string $initial 首字母
 */
class Company extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%company}}';
    }

    public function rules()
    {
        return [
            [['name', 'initial'], 'required'],
            [['name'], 'string', 'max' => 64],
            [['initial'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'initial' => '首字母',
        ];
    }

    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }
}
