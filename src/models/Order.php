<?php

namespace app\models;

use \app\models\base\Order as BaseOrder;

/**
 * This is the model class for table "orders".
 */
class Order extends BaseOrder
{
    public function formName()
    {
        return ' ';
    }
}
