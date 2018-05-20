<?php

namespace app\models;

use Overtrue\Pinyin\Pinyin;
use Yii;

/**
 * This is the model class for table "{{%invoice}}".
 *
 * @property int $id ID
 * @property string $company_name 公司名称
 * @property int $open_time 开票时间
 * @property string $number 发票号
 * @property string $money 发票金额
 * @property string $rate 增值率点
 * @property int $create_time 添加时间
 */
class Invoice extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%invoice}}';
    }

    public function rules()
    {
        return [
            [['company_name', 'number', 'open_time', 'money', 'rate'], 'required', 'message' => '必填'],
            [['money', 'rate'], 'number'],
            [['company_name'], 'string', 'max' => 64],
            [['number'], 'string', 'max' => 32],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_name' => '公司名称',
            'open_time' => '开票时间',
            'number' => '发票号',
            'money' => '发票金额',
            'rate' => '增值率点',
            'create_time' => '添加时间',
        ];
    }

    public static function find()
    {
        return new InvoiceQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->open_time = strtotime($this->open_time);
                $this->create_time = time();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!Company::find()->where(['name' => $this->company_name])->exists()) {
            $model = new Company;
            $pinyin = new Pinyin;
            $model->name = $this->company_name;
            $model->initial = $pinyin->abbr($this->company_name);
            $model->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
