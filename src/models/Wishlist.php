<?php

namespace app\models;

use \app\models\base\Wishlist as BaseWishlist;

/**
 * This is the model class for table "wishlists".
 */
class Wishlist extends BaseWishlist
{
    public function formName()
    {
        return ' ';
    }
}
