<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Universitas $model */

$this->title = 'Create Universitas';
$this->params['breadcrumbs'][] = ['label' => 'Universitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="universitas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
