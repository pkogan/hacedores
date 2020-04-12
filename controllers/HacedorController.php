<?php

namespace app\controllers;

use Yii;
use app\models\Hacedor;
use app\models\HacedorSearch;
use app\models\AsignacionSearch;
use app\models\ModeloSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HacedorController implements the CRUD actions for Hacedor model.
 */
class HacedorController extends Controller
{

    /**
     */
    public function actions(){
        return [
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::className(),
            ]
        ];
    } // actions
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
                        'actions' => ['publica'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update',
                                     'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN],
                    ],
                ],
            ],
        ];
    }


    public function actionEnviar_mensaje($id)
    {
        $hacedor = $this->findModel($id);
        $model = new \app\models\HacedorMensajeForm();
        $model->to_idHacedor = $id;

        if (Yii::$app->request->isPost &&
            $model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // Enviar correo.
                $model->enviar_correo();
                return $this->goHome();
            }
        }

        return $this->render('enviar_mensaje', [
            'model' => $model,
        ]);
    }

    /**
     */
    public function actionPublica(){
        $searchModel = new HacedorSearch();

        $param = Yii::$app->request->queryParams;
        $searchModel->con_produccion = true;
        $searchModel->rol = \app\models\Rol::ROL_MAKER;
        
        $dataProvider = $searchModel->search($param);

        return $this->render('publica', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } // actionPublica
    
    /**
     * Lists all Hacedor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HacedorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Hacedor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new AsignacionSearch();
        $searchModel->idHacedor=$id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $searchModel = new ModeloSearch();
        $searchModel->idHacedor=$id;
        $dataProviderModelo = $searchModel->search(Yii::$app->request->queryParams);

        

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'dataProviderModelo'=>$dataProviderModelo
        ]);
    }

    /**
     * Creates a new Hacedor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new Hacedor();
        $model->idUsuario=$id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idHacedor]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    
    
    
    /**
     * Updates an existing Hacedor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idHacedor]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Hacedor model.
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
     * Finds the Hacedor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Hacedor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Hacedor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
