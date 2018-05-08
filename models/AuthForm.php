<?php

namespace app\models;

use yii\base\Model;

class AuthForm extends Model
{
    private $_user;

    public $openId;

    public $unionId;

    public function rules()
    {
        return [
            [['openId'], 'required', 'on' => ['snsapiBase', 'snsapiUserinfo']],     // 公众平台授权
            [['unionId'], 'required', 'on' => 'snsapiLogin']                        // 开放平台授权
        ];
    }

    public function login()
    {
        if ($this->validate())
            return \Yii::$app->user->login($this->getUser(), 3600 * 24 * 30);
        return false;
    }

    public function getUser()
    {
        if ($this->_user === false)
            $this->_user = User::getByWechatInfo($this);
        return $this->_user;
    }
}