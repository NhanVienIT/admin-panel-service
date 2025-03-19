<?php

namespace app\api\v1\test\controllers;

use app\common\helper\response\ResponseHelper;
use Yii;

class TestController extends Controller
{
    public function actionIndex()
    {
//        var_dump(123);; die;
        $response = new ResponseHelper(['status' => 'OK']);
//        var_dump($response->build());die;
        return $response->build();
    }

}