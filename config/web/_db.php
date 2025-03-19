<?php
return [
    'class' => '\yii\db\Connection',
//    'dsn' => env("DB_DSN"),
    'dsn' => 'mysql:host=' . env("DB_HOST").';port=' . env("DB_PORT") . ';dbname=' . env("DB_NAME"),
    'username' => env("DB_USERNAME"),
    'password' => env("DB_PASSWORD"),
    'charset' => env("DB_CHARSET", "utf8"),
];