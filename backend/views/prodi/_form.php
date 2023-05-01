<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
// use yii\widgets\ActiveForm;

// kartik
use kartik\widgets\Select2;
use kartik\widgets\ActiveForm;

// model
use backend\models\Fakultas;

/** @var yii\web\View $this */
/** @var backend\models\Prodi $model */
/** @var yii\widgets\ActiveForm $form */

// $fakultas = new Fakultas();
// $fakultas->id = 1;

// var_dump(ArrayHelper::map(Fakultas::list(), 'id', 'nama'));
?>

<div class="prodi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fakultas_id')
        ->widget(Select2::class, [
            'data' => ArrayHelper::map(Fakultas::list(), 'id', 'nama'), // array yang diambil dari tabel Fakultas
            'options' => ['placeholder' => 'Pilih Fakultas'],
            'hideSearch' => true,
            'pluginOptions' => [
                'allowClear' => true,
            ]
        ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>