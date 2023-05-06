<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Mahasiswa $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mahasiswas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mahasiswa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nim',
            'nama_lengkap',
            'tmp_lahir',
            'tgl_lahir',
            'jenis_kelamin',
            'agama_id',
            'no_hp',
            'alamat',
            'prov_id',
            'kab_id',
            'kec_id',
            'kel_id',
            'kewarganegaraan_id',
            'angkatan',
            'nisn',
            'npsn_sekolah_asal',
            'foto_src',
            'foto_web',
            'prodi_id',
            'user_id',
        ],
    ]) ?>

</div>
