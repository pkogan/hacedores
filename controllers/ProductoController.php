<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoSearch;
use app\models\Hacedor;
use app\models\Rol;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller {

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
                'only' => ['index', 'view', 'update', 'delete', 'create', 'agregar'],
                'rules' => [
                    //'class' => AccessRule::className(),

                        [
                        'allow' => true,
                        'actions' => ['update', 'delete', 'agregar'],
                        'roles' => [\app\models\Rol::ROL_MAKER, Rol::ROL_GESTOR
                        ],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['index', 'view',
                            'update', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN,
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex() {
        $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);

        $searchModel = new ProductoSearch();

        $can_view['todos'] = false;

        // Nos aseguramos de que pueda ver sus productos a menos que tenga
        // los permisos.
        $params = Yii::$app->request->queryParams;
        if (Yii::$app->user->identity->idRol == Rol::ROL_ADMIN) {
            $can_view['todos'] = true;
        } else {
            if ($hacedor != null) {
                $params['ProductoSearch']['idHacedor'] = $hacedor->idHacedor;
            } else {
                $params['ProductoSearch']['idHacedor'] = -1;
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
     * Displays a single Producto model.
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
     */
    public function actionAgregar() {
        $producto = new Producto();

        $producto->idHacedor = \Yii::$app->user->identity->hacedor->idHacedor;

        if (Yii::$app->request->isPost && $producto->load(Yii::$app->request->post())) {
            $productoExistente = Producto::find()
                            ->where(['idModelo' => $producto->idModelo, 'idHacedor' => $producto->idHacedor
                            ])->one();
            if (!is_null($productoExistente)) {
                // El producto ya existe... sumar la cantidad.
                $productoExistente->cantidad += $producto->cantidad;
                $producto = $productoExistente;
            }
            if (\Yii::$app->user->identity->idRol == Rol::ROL_MAKER) {
                $producto->idTipoProducto = 1;
            } else {
                $producto->idTipoProducto = 2;
            }
            if ($producto->save()) {
                return $this->goHome();
            }
        }
        return $this->render('agregar', [
                    'model' => $producto,
        ]);
    }

// actionAgregar

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 
     * 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        // Si ya existe el producto, usarlo.
        if (Yii::$app->request->isPost) {
            $producto = Yii::$app->request->post('Producto');
        } else {
            $producto = Yii::$app->request->get('Producto');
        }
        if ($producto != null) {
            $modelo_id = $producto['idModelo'];
            $cant = $producto['cantidad'];
            $id_hacedor = $producto['idHacedor'];
        } else {
            $modelo_id = null;
            $cant = null;
            $id_hacedor = null;
        }

        if ($id_hacedor == null) {
            $hacedor = Hacedor::por_usuario(
                            Yii::$app->user->identity->idUsuario);
        } else {
            $hacedor = Hacedor::find($id_hacedor)->one();
        }


        $model = Producto::find()
                ->where(['idModelo' => $modelo_id,
                    'idHacedor' => $hacedor->idHacedor])
                ->one();

        $bien = true;
        if ($model == null) {
            $model = new Producto();
            $model->idHacedor = $hacedor->idHacedor;

            $bien = $model->load(Yii::$app->request->post());
        } else {
            // Si ya existe, sumamos la cantidad.
            $model->cantidad += $cant;
        }

        // Para mostrar u ocultar campos que no podría editar.
        $can_edit['idHacedor'] = false;
        if (Yii::$app->user->identity->idRol == Rol::ROL_ADMIN) {
            $can_edit['idHacedor'] = true;
        }

        // Intentamos guardar
        $bien = $bien && $model->save();
        if (Yii::$app->request->isPost && $bien) {
            return $this->redirect(['site/index']);
        }

        return $this->render('create', [
                    'model' => $model,
                    'can_edit' => $can_edit,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->idHacedor0->idUsuario != \Yii::$app->user->identity->idUsuario) {
            throw new \yii\base\UserException('Error al tratar de editar un Producto Ajeno.');
        }
         if (\Yii::$app->user->identity->idRol == Rol::ROL_MAKER) {
                $model->idTipoProducto = 1;
            } else {
                $model->idTipoProducto = 2;
            }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->goHome(); //$this->redirect(['view', 'id' => $model->idProducto]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $producto = $this->findModel($id);
        if ($producto->idHacedor0->idUsuario != \Yii::$app->user->identity->idUsuario) {
            throw new \yii\base\UserException('Esta intentando borrar un producto ajeno');
        }
        if ($producto->tiene_entregas()) {
            throw new \yii\base\UserException('No se puede borrar productos con entregas.');
        }

        $producto->delete();

        return $this->goHome(); //$this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
