<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\StatusMahasiswa $model */

$this->title = 'Create Status Mahasiswa';
$this->params['breadcrumbs'][] = ['label' => 'Status Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="status-mahasiswa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
