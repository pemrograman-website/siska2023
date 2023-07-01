<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\widgets\FileInput;

use backend\models\Dosen;
use backend\models\Agama;
use backend\models\Prodi;
use backend\models\Wilayah;
use backend\models\Pendidikan;
use backend\models\StatusDosen;
use backend\models\Universitas;


/** @var yii\web\View $this */
/** @var backend\models\Dosen $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dosen-form">

    <?php $form = ActiveForm::begin(
        [
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'options' => ['enctype' => 'multipart/form-data'], // wajib agar bisa kirim file (fileinput)
        ]
    ); ?>


    <?= $form->field($model, 'nidn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

        echo $form->field($model, 'username')->textInput(['maxlength' => true]);

        echo $form->field($model, 'email')->textInput(['maxlength' => true]);
    <?= $form->field($model, 'jenis_kelamin')->radioList(
        [
            Dosen::LAKI_LAKI => 'Laki-Laki',
            Dosen::PEREMPUAN => 'Perempuan'
        ],
        ['inline' => true]
    ); ?>

    <?= $form->field($model, 'tmp_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'tgl-bln-thn'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'd-m-yyyy' // 'd M yyyy' -> 10 Mei 1978
        ]
    ]); ?>

    <?= $form->field($model, 'agama_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Agama::list(), 'id', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Agama'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'homebase_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Prodi::list(), 'id', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Program Studi'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <!-- DEPENDENT DROPDOWN -->
    <!-- Provinsi Asal Dosen -->
    <?= $form->field($model, 'prov_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Wilayah::list(), 'kode', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Provinsi'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <!-- Kabupaten Asal Dosen -->
    <?php
    $kabList = [];
    if (isset($model->prov_id)) {
        $kabList = ArrayHelper::map(Wilayah::list($model->prov_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kab_id')
        ->widget(DepDrop::class, [
            'data' => $kabList,
            'options' => ['placeholder' => 'Pilih Kabupaten'],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ],
            'pluginOptions' => [
                'depends' => [Html::getInputId($model, 'prov_id')],
                'url' => Url::to(['/wilayah/dep-drop']),
                'loadingText' => 'Memuat Kab/Kota',
            ],
        ]);
    ?>

    <!-- Kecamatan Asal Dosen -->
    <?php

    $kecList = [];
    if (isset($model->kab_id)) {
        $kecList = ArrayHelper::map(Wilayah::list($model->kab_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kec_id')
        ->widget(DepDrop::class, [
            'data' => $kecList,
            'options' => ['placeholder' => 'Pilih Kecamatan'],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ],
            'pluginOptions' => [
                'depends' => [
                    Html::getInputId($model, 'prov_id'),
                    Html::getInputId($model, 'kab_id'),
                ],
                'url' => Url::to(['/wilayah/dep-drop']),
                'loadingText' => 'Memuat Kecamatan',
            ],
        ]);
    ?>

    <!-- Kelurahan Asal Dosen -->
    <?php
    $kelList = [];
    if (isset($model->kec_id)) {
        $kelList = ArrayHelper::map(Wilayah::list($model->kec_id), 'kode', 'nama');
    }

    echo $form->field($model, 'kel_id')
        ->widget(DepDrop::class, [
            'data' => $kelList,
            'options' => ['placeholder' => 'Pilih Kelurahan'],
            'type' => DepDrop::TYPE_SELECT2,
            'select2Options' => [
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ],
            'pluginOptions' => [
                'depends' => [
                    Html::getInputId($model, 'prov_id'),
                    Html::getInputId($model, 'kab_id'),
                    Html::getInputId($model, 'kec_id'),
                ],
                'initialize' => true,
                'initDepends' => [
                    Html::getInputId($model, 'prov_id'),
                ],
                'url' => Url::to(['/wilayah/dep-drop']),
                'loadingText' => 'Memuat Kelurahan',
            ],
        ]);
    ?>

    <!-- End of Dependent Dropdown Wilayah -->

    <?= $form->field($model, 'pendidikan_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Pendidikan::list(), 'id', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Pendidikan'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'status_dosen_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(StatusDosen::list(), 'id', 'keterangan'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Status Dosen'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'universitas_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Universitas::list(), 'id', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Universitas S2 Asal'],
            'hideSearch' => false,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <?= $form->field($model, 'fakultas_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_asal')->textInput(['maxlength' => true]) ?>

    <!-- Upload Foto -->
    <?php
    if (empty($model->foto_web)) {
        // Jika sebelumnya tidak ada unggahan foto
        $fotoSetting = [
            'options' => [
                'accept' => 'image/jpg',
                'multiple' => false,
            ],
            'pluginOptions' => [
                'allowedFileExtensions' => ['jpg', 'jpeg'],
                'maxFileSize' => 1024, // in kB
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'browseLabel' => 'Pilih Berkas',
                'cancelLabel' => 'Batal',
                'removeLabel' => 'Hapus',
                'removeClass' => 'btn btn-danger'
            ],
        ];
    } else {
        //  Jika sudah ada unggahan foto
        $fotoPreview = Yii::$app->params['fotoUrl'] . $model->foto_web;
        $fotoConfig = [
            'caption' => $model->foto_src,
        ];
        $fotoSetting = [
            'options' => [
                'accept' => 'image/jpg',
                'multiple' => false,
            ],
            'pluginOptions' => [  // reference: https://plugins.krajee.com/file-input/plugin-options
                'initialPreview' => $fotoPreview,
                'initialPreviewAsData' => true,  // set true jika ingin menampilkan gambar, bukan alamat saja
                'initialPreviewConfig' => $fotoConfig, // reference: https://plugins.krajee.com/file-input/plugin-options#initialPreviewConfig
                'initialPreviewShowDelete' => false,  // Menghilangkan tombol hapus di preview
                'allowedFileExtensions' => ['jpg', 'jpeg'],
                'maxFileSize' => 1024, // in kB
                'overwriteInitial' => true, // set false jika ingin menambahkan file, set true jika ingin menimpa file
                'showRemove' => false,
                'showUpload' => false,
                'showCancel' => false,
                'showClose' => false,
                'browseLabel' => 'Pilih Berkas',
                'removeLabel' => 'Hapus',
                'removeClass' => 'btn btn-danger',
            ],
        ];
    }

    echo $form->field($model, 'fotoBerkas')->widget(FileInput::class, $fotoSetting);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>