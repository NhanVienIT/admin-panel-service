<?php

namespace app\modules\v1\admin\user\models\form;

use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use app\modules\v1\admin\user\models\User;


class UserForm extends User
{
    public $password;
    public $role;

    public function rules()
    {
        return array_merge(parent::rules(), [
            [["email", "username", "role"], "required"],
            [["email", "username"], "unique", 'filter' => [
                "!=", "status", self::STATUS_DELETED
            ]],
            ["password", "required", "on" => self::SCENARIO_CREATE],
            [["username", "password"], "string", "min" => 6,
                "tooShort" => "{attribute} should contain at least 6 characters."],
            ["email", "email"],
            ["status", "default", "value" => self::STATUS_ACTIVE],
            ["role", "in", "range" => [
                self::ROLE_USER,
                self::ROLE_ADMIN,
            ]]
        ]);
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function beforeSave($insert): bool
    {
        if ($this->password) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }

    /**
     * @throws \Exception
     */
    public function afterSave($insert, $changedAttributes): void
    {
        if ($this->role) {
            $auth = Yii::$app->authManager;
            $auth->revokeAll($this->getId());
            $auth->assign($auth->getRole($this->role), $this->getId());
            parent::afterSave($insert, $changedAttributes);
        }
    }
}
