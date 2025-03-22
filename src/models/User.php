<?php

namespace app\models;

use \app\models\base\User as BaseUser;

/**
 * This is the model class for table "user".
 */
class User extends UserIdentify
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = -99;
    const ROLE_ADMIN = "admin";
    const ROLE_USER = "user";
    const SCENARIO_CREATE = "create";

    public function formName()
    {
        return ' ';
    }
}
