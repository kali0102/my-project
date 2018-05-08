<?php

namespace app\modules\h5\controllers;

use EasyWeChat\Factory;
use app\models\AuthForm;
use app\components\Controller;

class CallbackController extends Controller
{
    public function actionIndex()
    {
        $configs = \Yii::$app->params['wechat'];
        $app = Factory::officialAccount($configs);

        $user = $app->oauth->user();
        $userInfo = $user->getOriginal();

        // unionid
        // $info = $app->user->get($userInfo['openid']);

        $model = new AuthForm;
        $model->scenario = 'snsapiBase';
        $model->openId = $userInfo['openid'];

        if ($model->login())
            return $this->redirect($_GET['targetUrl']);
        \Yii::$app->end();
    }
}