<?php

namespace app\controllers;

use Yii;
use app\models\Modelo;
use app\models\ModeloSearch;
use app\models\Rol;
use app\models\Hacedor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModeloController implements the CRUD actions for Modelo model.
 */
class ModeloController extends Controller
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
                        'actions' => ['index', 'view',
                                     'update', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'index', 'view',
                        ],
                        'roles' => [
                            \app\models\Rol::ROL_MAKER,
                            \app\models\Rol::ROL_GESTOR,
                        ],
                    ],
                            
                ],
            ],
        ];
    }

    /**
     * Lists all Modelo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModeloSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $can_edit['create'] = $this->tiene_rol(Rol::ROL_ADMIN);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'can_edit' => $can_edit,
        ]);
    }

    /**
     * Displays a single Modelo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        $can_edit['editar'] = $this->tiene_rol(ROL::ROL_ADMIN);
        $can_edit['eliminar'] = $this->tiene_rol(ROL::ROL_ADMIN);
        $can_edit['reservar'] = $this->tiene_rol(ROL::ROL_ADMIN) ||
                                $this->tiene_rol(ROL::ROL_GESTOR);;
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'can_edit' => $can_edit,
        ]);
    }

    /**
     * Creates a new Modelo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $hacedor = Hacedor::por_usuario(
            Yii::$app->user->identity->idUsuario);
        $model = new Modelo();
        $model->idHacedor = $hacedor->idHacedor;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idModelo]);
        }

        $can_edit['idHacedor'] = $this->tiene_rol(Rol::ROL_ADMIN);

        
        return $this->render('create', [
            'model' => $model,
            'can_edit' => $can_edit,
        ]);
    }

    /**
     * Updates an existing Modelo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idModelo]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Modelo model.
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
     * Finds the Modelo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Modelo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modelo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function tiene_rol($rol){
        return Yii::$app->user->identity->idRol == $rol;
    }
}
