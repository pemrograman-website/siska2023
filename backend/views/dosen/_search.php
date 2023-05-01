<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DosenSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dosen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nidn_nip') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'jenis_kelamin') ?>

    <?= $form->field($model, 'tmp_lahir') ?>

    <?php // echo $form->field($model, 'tgl_lahir') ?>

    <?php // echo $form->field($model, 'agama_id') ?>

    <?php // echo $form->field($model, 'homebase_id') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'prov_id') ?>

    <?php // echo $form->field($model, 'kab_id') ?>

    <?php // echo $form->field($model, 'kec_id') ?>

    <?php // echo $form->field($model, 'kel_id') ?>

    <?php // echo $form->field($model, 'pendidikan_id') ?>

    <?php // echo $form->field($model, 'status_dosen_id') ?>

    <?php // echo $form->field($model, 'universitas_id') ?>

    <?php // echo $form->field($model, 'fakultas_asal') ?>

    <?php // echo $form->field($model, 'prodi_asal') ?>

    <?php // echo $form->field($model, 'foto_src') ?>

    <?php // echo $form->field($model, 'foto_web') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
