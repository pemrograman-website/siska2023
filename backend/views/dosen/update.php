<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Dosen $model */

$this->title = 'Update: ' . $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Dosen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama_lengkap, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dosen-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>