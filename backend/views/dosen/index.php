<?php

use backend\models\Dosen;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\DosenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dosens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dosen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Dosen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nidn_nip',
            'nama_lengkap',
            'jenis_kelamin',
            'tmp_lahir',
            //'tgl_lahir',
            //'agama_id',
            //'homebase_id',
            //'no_hp',
            //'alamat',
            //'prov_id',
            //'kab_id',
            //'kec_id',
            //'kel_id',
            //'pendidikan_id',
            //'status_dosen_id',
            //'universitas_id',
            //'fakultas_asal',
            //'prodi_asal',
            //'foto_src',
            //'foto_web',
            //'user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Dosen $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
