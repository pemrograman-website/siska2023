<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Dosen $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="dosen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nidn_nip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_kelamin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tmp_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_lahir')->textInput() ?>

    <?= $form->field($model, 'agama_id')->textInput() ?>

    <?= $form->field($model, 'homebase_id')->textInput() ?>

    <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prov_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kab_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kec_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kel_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pendidikan_id')->textInput() ?>

    <?= $form->field($model, 'status_dosen_id')->textInput() ?>

    <?= $form->field($model, 'universitas_id')->textInput() ?>

    <?= $form->field($model, 'fakultas_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'prodi_asal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_src')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
