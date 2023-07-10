<?php

use yii\helpers\Url;

return [
    [
        'label' => 'DOSEN',
        'header' => true,
    ],
    [
        'label' => 'Profil',
        'icon' => 'user-tie',
        'url' => Url::toRoute(['/dosen/view', 'id' => Yii::$app->user->identity->profil->id])
    ],
    [
        'label' => 'Perkuliahan',
        'icon' => 'database',
        'items' => [
            ['label' => 'Jadwal',  'icon' => 'building', 'url' => ['/fakultas']],
            ['label' => 'Jurnal',  'icon' => 'university', 'url' => ['/prodi']],
            ['label' => 'Penilaian',  'icon' => 'book', 'url' => ['/gii']],
            ['label' => 'Unggah RPP/RPS',  'icon' => 'users', 'url' => ['/dosen']],
        ],
    ],
];
