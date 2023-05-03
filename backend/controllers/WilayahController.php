<?php

namespace backend\controllers;

use Yii;
use backend\models\Wilayah;
use backend\models\WilayahSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * WilayahController implements the CRUD actions for Wilayah model.
 */
class WilayahController extends Controller
{
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
     * Lists all Wilayah models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new WilayahSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wilayah model.
     * @param string $kode Kode
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode)
    {
        return $this->render('view', [
            'model' => $this->findModel($kode),
        ]);
    }

    /**
     * Creates a new Wilayah model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Wilayah();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'kode' => $model->kode]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Wilayah model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $kode Kode
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode)
    {
        $model = $this->findModel($kode);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'kode' => $model->kode]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Wilayah model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $kode Kode
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode)
    {
        $this->findModel($kode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wilayah model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $kode Kode
     * @return Wilayah the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($kode)
    {
        if (($model = Wilayah::findOne(['kode' => $kode])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /* DEPENDENT DROPDOWN WILAYAH */
    public function actionDepDrop()
    {
        // Kita pastikan response berupa JSON
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Buat array untuk menampung hasil combo box
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            // Ambil ID provinsi dari combo box sebelumnya
            $id = end($_POST['depdrop_parents']);
            $list = Wilayah::list($id);
            $selected = null;
            if ($id != null && count($list) > 0) {
                $selected = '';
                foreach ($list as $i => $wilayah) {
                    $out[] = ['id' => $wilayah['kode'], 'name' => $wilayah['nama']];
                    if ($i == 0) {
                        $selected = $wilayah['kode'];
                    }
                }
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
}
