<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Mahasiswa $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mahasiswa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmp_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput() ?>

    <?= $form->field($model, 'jenis_kelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agama_id')->textInput() ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prov_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kab_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kec_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kel_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kewarganegaraan_id')->textInput() ?>

    <?= $form->field($model, 'angkatan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nisn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'npsn_sekolah_asal')->textInput() ?>

    <?= $form->field($model, 'foto_src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
