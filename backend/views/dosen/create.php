<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Dosen $model */

$this->title = 'Tambah Data Dosen';
$this->params['breadcrumbs'][] = ['label' => 'Dosen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>