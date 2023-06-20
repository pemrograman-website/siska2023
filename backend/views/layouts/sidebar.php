<?php

use common\models\User;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= $assetDir ?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SISKA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $assetDir ?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php

            $sidebar = [];

            if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, User::ROLE_ADMIN)) {
                $sidebar = require __DIR__ . '/_sidebar-admin.php';
            } else if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, User::ROLE_AKADEMIK)) {
                $sidebar = require __DIR__ . '/_sidebar-akademik.php';
            } else if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, User::ROLE_DOSEN)) {
                $sidebar = require __DIR__ . '/_sidebar-dosen.php';
            } else if (Yii::$app->authManager->checkAccess(Yii::$app->user->id, User::ROLE_MAHASISWA)) {
                $sidebar = require __DIR__ . '/_sidebar-mahasiswa.php';
            }

            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => $sidebar,
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>