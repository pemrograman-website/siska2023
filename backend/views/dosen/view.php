<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Dosen $model */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Dosen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="dosen-view">

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
            'nidn',
            'nip',
            'nama_lengkap',
            'jenis_kelamin',
            'tmp_lahir',
            'tgl_lahir',
            'agama_id',
            'homebase_id',
            'no_hp',
            'alamat',
            'prov_id',
            'kab_id',
            'kec_id',
            'kel_id',
            'pendidikan_id',
            'status_dosen_id',
            'universitas_id',
            'fakultas_asal',
            'prodi_asal',
            'foto_src',
            'foto_web',
            'user_id',
        ],
    ]) ?>

</div>