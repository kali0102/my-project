<?php

namespace app\modules\h5\components;

use EasyWeChat\Factory;
use app\components\Controller;

/**
 * 公众号授权
 */
class AuthController extends Controller
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            $request = \Yii::$app->getRequest();
            $urlManager = \Yii::$app->getUrlManager();

            $targetUrl = $request->getHostInfo() . $request->getUrl();
            $callbackUrl = $urlManager->createAbsoluteUrl(['/h5/callback', 'targetUrl' => $targetUrl]);

            $configs = \Yii::$app->params['wechat'];
            $configs['oauth']['scopes'] = ['snsapi_base'];
            $configs['oauth']['callback'] = $callbackUrl;

            $app = Factory::officialAccount($configs);
            $app->oauth->redirect()->send();
        }
        return parent::beforeAction($action);
    }
}