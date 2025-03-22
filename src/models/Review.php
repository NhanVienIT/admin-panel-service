<?php

namespace app\models;

use \app\models\base\Review as BaseReview;

/**
 * This is the model class for table "reviews".
 */
class Review extends BaseReview
{
    public function formName()
    {
        return ' ';
    }
}
