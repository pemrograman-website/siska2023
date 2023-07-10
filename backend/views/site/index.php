<?php

use yii\helpers\VarDumper;

$this->title = 'DASHBOARD';
$this->params['breadcrumbs'] = [['label' => $this->title]];

// echo '<pre>';
// VarDumper::dump(Yii::$app->user->identity, 100, true);
// echo '</pre>';

// var_dump(Yii::$app->user->identity);

// echo Yii::$app->user->identity->profile;
// die();
?>
<div class="container-fluid">
    <h1>Selamat Datang, <?= is_null(Yii::$app->user->identity->profil) ? '' : Yii::$app->user->identity->profil->nama_lengkap; ?></h1>
</div>