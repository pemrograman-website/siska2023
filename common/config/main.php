<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],

        // Komponen jika kita ingin menggunakan RBAC dengan basisdata
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ]
    ],
    'language' => 'id-ID',
    'timeZone' => 'Asia/Jakarta',
];
