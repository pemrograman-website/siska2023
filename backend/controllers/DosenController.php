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
        $model->scenario = 'create';

        // Cek validasi Ajax
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->validasiData()) {
                    $transaction = Yii::$app->db->beginTransaction(\yii\db\Transaction::SERIALIZABLE);

                    try {
                        // Membuat User baru dan simpan
                        $user = new \common\models\User();
                        $user->username = $model->username;
                        $user->email = $model->email;
                        $user->setPassword(str_replace("-", "", $model->tgl_lahir)); // untuk awalan, gunakan tanggal 1-1-1988
                        $user->status = \common\models\User::STATUS_ACTIVE;

                        if ($user->save(false)) {
                            // Membuat penugasan User baru tersebut dengan role 'dosen'
                            $auth = new \yii\rbac\DbManager;
                            $auth->init();
                            $getrole = $auth->getRole('dosen');
                            $auth->assign($getrole, $user->id);

                            // Update user_id pada Dosen dengan id pada User
                            $model->user_id = $user->id;
                        } else {
                            throw new ServerErrorHttpException('Data User tidak bisa disimpan');
                        }

                        // Kontainer untuk foto
                        $foto = $model->uploadFoto();

                        // Menyimpan Dosen tanpa validasi, karena validasi sudah dilakukan di atas
                        if ($model->save(false)) {
                            if ($foto !== false) {
                                // Simpan foto
                                $foto->saveAs($model->getFotoWeb());
                            }

                            $transaction->commit();
                            return $this->redirect(['view', 'id' => $model->id]);
                        } else {
                            // var_dump($model->errors);
                            // die();
                            throw new ServerErrorHttpException('Data tidak berhasil disimpan');
                        }
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        throw $e;
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
        $model->scenario = 'update';

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

                    if ($model->save(false)) {
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
