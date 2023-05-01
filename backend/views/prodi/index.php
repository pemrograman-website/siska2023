<?php

use backend\models\Prodi;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
// use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;

// models
use backend\models\Fakultas;

/** @var yii\web\View $this */
/** @var backend\models\ProdiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Program Studi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodi-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Tambah Program Studi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'kode',
            'nama',
            [
                'header' => 'Fakultas',
                'attribute' => 'fakultas_id',
                'value' => 'fakultas.nama',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(Fakultas::list(), 'id', 'nama'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                    'hideSearch' => true,
                    'size' => 'sm',
                ],
                'filterInputOptions' => ['placeholder' => 'Pilih ...'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Prodi $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>