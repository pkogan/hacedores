<?php

namespace app\controllers;

use Yii;
use app\models\Entrega;
use app\models\EntregaSearch;
use app\models\Hacedor;
use app\models\Producto;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntregaController implements the CRUD actions for Entrega model.
 */
class EntregaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Entrega models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EntregaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entrega model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entrega model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entrega();
        $model->fecha = date('d/m/Y');

        if (Yii::$app->request->isPost){
            $model->load(Yii::$app->request->post());
            $model->fecha =  date("Y-m-d", strtotime($model->fecha));
            
            if ($model->cantidad > $model->producto->cantidad){
                $bien = false;
            }

            $model->producto->cantidad -= $model->cantidad;
            if (!$model->producto->save()){
                $error = 'No se pudo guardar el producto';
                throw new \Exception($error);
            }else{
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->idEntrega]);
                }
            }
        }

        $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);
        $productos = Producto::find()
                             ->where(['idHacedor' => $hacedor->idHacedor])
                             ->all();

        
        return $this->render('create', [
            'model' => $model,
            'productos' => $productos,
        ]);
    }

    /**
     * Updates an existing Entrega model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idEntrega]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Entrega model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entrega model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entrega the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entrega::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
