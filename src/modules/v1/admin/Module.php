<?php

namespace app\modules\v1\admin;

class Module extends \yii\base\Module
{
    public function init()
    {
        $this->modules = [
            "product" => product\Module::class,
            "user" => user\Module::class,
        ];
    }

}