<?php

namespace backend\controllers;

use Yii;
use backend\models\Dosen;
use backend\models\DosenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use kartik\form\ActiveForm;
use yii\web\ServerErrorHttpException;

// ini_set("xdebug.var_display_max_children", '-1');
// ini_set("xdebug.var_display_max_data", '-1');
// ini_set("xdebug.var_display_max_depth", '-1');

/**
 * DosenController implements the CRUD actions for Dosen model.
 */
class DosenController extends Controller
{
    /**
     * Definisikan semua parameter di sini.
     */
    private static function setParams()
    {
        // Parameter 'fotoUrl' untuk mengakses url dari berkas foto
        Yii::$app->params['fotoUrl'] = Yii::getAlias('@web/foto/');
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Dosen models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DosenSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dosen model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Dosen model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        self::setParams();
        $model = new Dosen();

        // Cek validasi Ajax
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->validasiData()) {
                    // Kontainer untuk foto
                    $foto = $model->uploadFoto();

                    if ($model->save()) {
                        if ($foto !== false) {
                            // Simpan foto
                            $foto->saveAs($model->getFotoWeb());
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        throw new ServerErrorHttpException('Data tidak berhasil disimpan');
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dosen model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        self::setParams();

        $model = $this->findModel($id);

        // Cek validasi Ajax
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->validasiData()) {
                    // Kontainer untuk foto
                    $foto = $model->uploadFoto();

                    if ($model->save()) {
                        if ($foto !== false) {
                            // Simpan foto
                            $foto->saveAs($model->getFotoWeb());
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        throw new ServerErrorHttpException('Data tidak berhasil disimpan');
                    }
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dosen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dosen model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Dosen the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dosen::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
