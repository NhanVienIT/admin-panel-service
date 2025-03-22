<?php

namespace app\modules\v1\admin\user\models\form;

use app\models\AuthAssignment;
use app\modules\v1\admin\user\models\User;

class UserLoginForm extends User
{
    public $password;

    public function rules()
    {
        return ([
            ["email", "required"],
            ["password", "required"]
        ]);
    }

    /**
     * @throws \Exception
     */
    public function login()
    {
        $user = self::findByLogin($this->email);
        if (!$user) {
            $this->addError("email", "Email or Username user not found");
            return false;
        }
        if (!$user->validatePassword($this->password)) {
            $this->addError("password", "Account Invalid");
            return false;
        }
        $userAdmin = AuthAssignment::find()->where(['user_id' => $user->id])->one();
        if ($userAdmin && $userAdmin->item_name === self::ROLE_USER) {
            $this->addError("user", "User cannot login");
            return false;
        }

        $user->generateToken();
        return $user;
    }

}