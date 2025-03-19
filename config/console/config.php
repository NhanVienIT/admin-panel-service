<?php
$config = [
    'id' => 'console',
    'basePath' => dirname(__DIR__,2)."/src",
    'controllerNamespace' => 'app\commands',
    'controllerMap' => [
        'migrate' => [
            'class' => yii\console\controllers\MigrateController::class,
            'migrationPath' => '@app/migrations/db',
            'migrationTable' => '{{%system_db_migration}}'
        ],
        'batch' => [
            'class' => 'schmunk42\giiant\commands\BatchController',
            'interactive' => false,
            'overwrite' => true,
            'skipTables' => ['system_db_migration','system_rbac_migration'],
            'modelNamespace' => 'app\models',
            'crudTidyOutput' => false,
            'useTranslatableBehavior' => true,
            'useTimestampBehavior' => true,
            'enableI18N' => false,
            'modelQueryNamespace' => 'app\models',
            'modelBaseClass' => yii\db\ActiveRecord::className(),
            'modelQueryBaseClass' => yii\db\ActiveQuery::className()
        ],
    ],
    'components' => [
        'db' => require('_db.php'),
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
    ]
];
if (YII_ENV_DEV) {
    // Gii Config
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        'allowedIPs' => [
            '*'
        ]
    ];
}
return $config;