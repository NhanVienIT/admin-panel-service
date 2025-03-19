<?php

namespace app\helpers;

use JetBrains\PhpStorm\ArrayShape;
use Yii;
use yii\data\DataProviderInterface;
use yii\rest\Serializer;
use yii\web\HttpException;

class ResponseBuilder
{

    #[ArrayShape(["status" => "bool", "data" => "mixed", "messages" => "string", "code" => "int"])] public static function json(bool $status = true, $data = null, string $message = "", int $code = 200): array
    {
        Yii::$app->response->statusCode = $code;
        if ($data instanceof DataProviderInterface) {
            $serializer = new Serializer(['collectionEnvelope' => 'items']);
            $data = $serializer->serialize($data);
        }
        return [
            "status" => $status,
            "data" => $data,
            "messages" => $message,
            "code" => $code
        ];
    }
}
