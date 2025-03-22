<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use \app\models\base\UserToken as BaseUserToken;

/**
 * This is the model class for table "user_token".
 */
class UserToken extends BaseUserToken
{
    public $tokenExpiration = 60 * 24 * 365; // in seconds
    public $defaultAccessGiven = '{"access":["all"]}';
    public const TYPE_ACTIVATION = 'activation';
    public const TYPE_PASSWORD_RESET = 'password_reset';
    public const TYPE_LOGIN_PASS = 'login_pass';
    protected const TOKEN_LENGTH = 40;
    public $defaultConsumer = 'web';

    /**
     * @throws Exception|\yii\base\Exception
     */
    public static function generateAuthKey($user): void
    {
        $token = Yii::$app->security->generateRandomString();
        $accessToken = new UserToken();
        $accessToken->user_id = $user->id;
        $accessToken->type = $user->type ?? $accessToken->defaultConsumer;
        $accessToken->token = $token;
        $accessToken->expire_at = $accessToken->tokenExpiration + time();
        $user->token = $token;
        $user->save(false);
        $accessToken->save(false);
    }
}
