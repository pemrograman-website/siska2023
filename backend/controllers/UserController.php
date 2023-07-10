<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\widgets\ActiveForm;
use yii\web\Response;

// Model
use backend\models\UbahPasswordForm;

class UserController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
        );
    }

    public function actionUbahPassword()
    {
        $model = new UbahPasswordForm();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate() && $model->ubahPassword() == true) {
                    // Beritahu user, password baru sudah tersimpan
                    Yii::$app->session->setFlash('success', [
                        'type' => 'success',
                        'duration' => 3000,
                        'icon' => 'fa fa-key',
                        'message' => 'Password baru berhasil disimpan.',
                        'title' => 'BERHASIL',
                        'showSeparator' => true,
                        'iconType' => 'image',
                        'positionX' => 'top',
                        'positionY' => 'center',
                    ]);

                    return $this->redirect(['site/index']);
                }
            }
        }

        return $this->render('ubah-password', ['model' => $model]);
    }
}
