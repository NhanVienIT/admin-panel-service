<?php
return [
    'class' => '\yii\db\Connection',
    'dsn' => env("DB_DSN"),
    'username' => env("DB_USERNAME"),
    'password' => env("DB_PASSWORD"),
    'charset' => env("DB_CHARSET", "utf8"),
];