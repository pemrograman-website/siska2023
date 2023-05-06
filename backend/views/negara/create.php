<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Negara $model */

$this->title = 'Create Negara';
$this->params['breadcrumbs'][] = ['label' => 'Negaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="negara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
