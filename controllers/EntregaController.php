<?php

namespace app\controllers;

use Yii;
use app\models\Entrega;
use app\models\EntregaSearch;
use app\models\Hacedor;
use app\models\Producto;
use app\models\Rol;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EntregaController implements the CRUD actions for Entrega model.
 */
class EntregaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => \app\models\AccessRule::className(),
                ],
                'only' => ['index', 'view', 'update', 'delete', 'create'],
                'rules' => [
                    //'class' => AccessRule::className(),
                        [
                        'allow' => true,
                        'actions' => ['index', 'view',
                            'update', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN,
                            \app\models\Rol::ROL_MAKER],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Entrega models.
     * @return mixed
     */
    public function actionIndex() {
        $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);
        $can_view['todos'] = false;

        $searchModel = new EntregaSearch();
        // Nos aseguramos de que pueda ver sus productos a menos que tenga
        // los permisos.
        $params = Yii::$app->request->queryParams;
        if (Yii::$app->user->identity->idRol == Rol::ROL_ADMIN) {
            $can_view['todos'] = true;
        } else {
            if ($hacedor != null) {
                $params['EntregaSearch']['idHacedor'] = $hacedor->idHacedor;
            } else {
                $params['EntregaSearch']['idHacedor'] = -1;
            }
        }

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'can_view' => $can_view,
        ]);
    }

    /**
     * Displays a single Entrega model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entrega model.
     * If creation is successful, the browser will be redirected to
     * the 'view' page.
     * @return mixed
     */
    protected function validarDuenoProducto($model) {
        if ($model !== null) {
            if ($model->idHacedor0->idUsuario != \Yii::$app->user->identity->idUsuario) {
                throw new \yii\web\HttpException('Está intentando crear una entrega para un producto ajeno');
            }
        } else {
            throw new NotFoundHttpException('No existe el Producto');
        }
    }

    public function actionCreate($idProducto) {
        $this->validarDuenoProducto(Producto::findOne($idProducto));


        $model = new Entrega();
        $model->idProducto = $idProducto;
        $model->fecha = date('Y-m-d');
        
        $bien = true;
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // Cambiar el formato recibido por el Widget (d/m/Y) al que
            // soporta MySQL (Y-m-d).
            /*$date = \DateTime::createFromFormat('d/m/Y', $model->fecha);
            $model->fecha = $date->format('Y-m-d');
*/
            if ($model->cantidad > $model->producto->stock) {
                $model->addError('cantidad', 'La cantidad a entregar supera a la del producto('.$model->producto->stock.')') ;
            } else {
                if (!$model->producto->save()) {
                    $error = 'No se pudo actualizar el producto';
                    throw new \Exception($error);
                }
                if ($model->save()) {
                    return $this->goHome(); //$this->redirect(['site/index']);
                }
            }
        }

        // Seteamos los valores por defecto
        /*if ($model->fecha == null) {
            $model->fecha = date('d/m/Y');
        } else {
            $model->fecha = date("d/m/Y", strtotime($model->fecha));
        }*/


        $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);
        $productos = Producto::find()
                ->where(['idHacedor' => $hacedor->idHacedor])
                ->all();


        return $this->render('create', [
                    'model' => $model,
                    'productos' => $productos,
                    'error' => $error,
        ]);
    }

    /**
     * Updates an existing Entrega model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $this->validarDuenoProducto($model->producto);
        $stockSinActual = $model->producto->stock + $model->cantidad;
        if ($model->load(Yii::$app->request->post())) {
            
            if ($model->cantidad > $stockSinActual) {
                $model->addError('cantidad', 'La cantidad a entregar supera a la del producto('.$stockSinActual.')');
            } elseif ($model->save()) {
                return $this->goHome();
            }
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
    public function actionDelete($id) {
        $model = $this->findModel($id);

        $this->validarDuenoProducto($model->producto);
        $model->delete();

        return $this->goHome();
    }

    /**
     * Finds the Entrega model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entrega the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Entrega::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
