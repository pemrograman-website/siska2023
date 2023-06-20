<?php

return [
    [
        'label' => 'AKADEMIK',
        'header' => true,
    ],
    [
        'label' => 'Data Master',
        'icon' => 'database',
        'items' => [
            ['label' => 'Fakultas',  'icon' => 'building', 'url' => ['/fakultas']],
            ['label' => 'Prodi',  'icon' => 'university', 'url' => ['/prodi']],
            ['label' => 'Mata Kuliah',  'icon' => 'book', 'url' => ['/gii']],
            ['label' => 'Dosen',  'icon' => 'users', 'url' => ['/dosen']],
            ['label' => 'Mahasiswa',  'icon' => 'graduation-cap', 'url' => ['/mahasiswa']],
            ['label' => 'Ruang',  'icon' => 'home', 'url' => ['/gii']],
            ['label' => 'Staff',  'icon' => 'users', 'url' => ['/gii']],
        ],
    ],
];
