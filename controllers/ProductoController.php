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
class ProductoController extends Controller
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
                        'actions' => ['index', 'view', 'update', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);

        $searchModel = new ProductoSearch();

        $can_view['todos'] = false;

        // Nos aseguramos de que pueda ver sus productos a menos que tenga
        // los permisos.
        $params = Yii::$app->request->queryParams;
        if (Yii::$app->user->identity->idRol == Rol::ROL_ADMIN){
            $can_view['todos'] = true;
        }else{
            $params['ProductoSearch']['idHacedor'] = $hacedor->idHacedor;
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
    public function actionView($id)
    {        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     */
    public function actionAgregar(){
        if (Yii::$app->request->isPost){
            $modelo_id = Yii::$app->request->post('Producto[idModelo]');
            $producto = Producto::find()
                                ->where(['idModelo' => $modelo_id])
                                ->one();
            
            if ($producto == null){
                // No hay producto asociado... crearlo.
                $producto = new Producto();
                $producto->load(Yii::$app->request->post());
            }else{
                // El producto ya existe... sumar la cantidad.
                $cant = Yii::$app->request->post('Producto[cantidad]');
                $producto->cantidad += $cant;
            }

            if ($producto->save()){
                return $this->redirect(['view', 'id' => $producto->idProducto]);
            }
            return $this->render('agregar', [
                'model' => $producto,
                'can_edit' => $can_edit,
            ]);
        }
    } // actionAgregar
    
    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 
     * 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // Si ya existe el producto, usarlo.
        $producto = Yii::$app->request->post('Producto');
        if ($producto != null){
            $modelo_id = $producto['idModelo'];
            $cant = $producto['cantidad'];
            $id_hacedor = $producto['idHacedor'];
        }else{
            $modelo_id = null;
            $cant = null;
            $id_hacedor = null;
        }

        if ($id_hacedor == null){
            $hacedor = Hacedor::por_usuario(
                Yii::$app->user->identity->idUsuario);
        }else{
            $hacedor = Hacedor::find($id_hacedor)->one();
        }

        
        $model = Producto::find()
                         ->where(['idModelo' => $modelo_id,
                                 'idHacedor' => $hacedor->idHacedor])
                         ->one();

        $bien = true;
        if ($model == null){
            $model = new Producto();
            $model->idHacedor = $hacedor->idHacedor;

            $bien = $model->load(Yii::$app->request->post());
        }else{
            // Si ya existe, sumamos la cantidad.
            $model->cantidad += $cant;
        }

        // Para mostrar u ocultar campos que no podría editar.
        $can_edit['idHacedor'] = false;
        if (Yii::$app->user->identity->idRol == Rol::ROL_ADMIN){
            $can_edit['idHacedor'] = true;
        }

        // Intentamos guardar
        $bien = $bien && $model->save();
        if (Yii::$app->request->isPost && $bien) {
            return $this->redirect(['index']);
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
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idProducto]);
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
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
