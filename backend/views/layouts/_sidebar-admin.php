<?php

return [
    [
        'label' => 'ADMIN',
        'header' => true,
    ],
    ['label' => 'Gii',  'icon' => 'tools', 'url' => ['/gii'], 'target' => '_blank'],
    ['label' => 'RBAC',  'icon' => 'user-shield', 'url' => ['/admin'], 'target' => '_blank'],
    [
        'label' => 'Data LookUp',
        'icon' => 'database',
        'items' => [
            ['label' => 'Agama',  'icon' => 'star-and-crescent', 'url' => ['/agama']],
            ['label' => 'Status Dosen',  'icon' => 'user-graduate', 'url' => ['/status-dosen']],
            ['label' => 'Status Mahasiswa',  'icon' => 'graduation-cap', 'url' => ['/status-mahasiswa']],
            ['label' => 'Universitas',  'icon' => 'university', 'url' => ['/universitas']],
            ['label' => 'Wilayah',  'icon' => 'globe', 'url' => ['/wilayah']],
            ['label' => 'Pendidikan Terakhir',  'icon' => 'school', 'url' => ['/pendidikan']],
            ['label' => 'Negara',  'icon' => 'globe-asia', 'url' => ['/negara']],

        ],
    ],
];
