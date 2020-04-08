<?php

namespace app\controllers;

use Yii;
use app\models\Institucion;
use app\models\InstitucionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InstitucionController implements the CRUD actions for Institucion model.
 */
class InstitucionController extends Controller
{
    /**
     * {@inheritdoc}
     */
        public function actionCombo() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $idProvincia = $parents[0];
                $idCiudad = $parents[1];
                $out = \yii\helpers\ArrayHelper::toArray(\app\models\Institucion::find()->where("idCiudad in ($idCiudad) and idTipologia=10")->orderBy('nombre')->all(), [
                            'app\models\Institucion' => [
                                'id' => 'idInstitucion',
                                'name' => 'nombre'
                            ]
                ]);
                //hack otro
                        $optionsInstitucion['data'][Institucion::OTROID]=Institucion::NOMBRES[Institucion::OTROID];
        
        //if(Yii::$app->user->identity->idRol== \app\models\Rol::ROL_MAKER){
    
                
                $out= array_merge( $out,[['id'=>Institucion::OTROID,'name'=>Institucion::NOMBRES[Institucion::OTROID]],
                    ['id'=>Institucion::CENTROENSAMLADOID,'name'=>Institucion::NOMBRES[Institucion::CENTROENSAMLADOID]],
                    ['id'=>Institucion::CENTRODISTSALUDID,'name'=>Institucion::NOMBRES[Institucion::CENTRODISTSALUDID]]]);
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }
    
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
                        [
                        'allow' => true,
                        'actions' => ['index', 'view', 'update', 'delete', 'create'],
                        'roles' => [\app\models\Rol::ROL_ADMIN, \app\models\Rol::ROL_GESTOR],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Institucion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InstitucionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Institucion model.
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
     * Creates a new Institucion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Institucion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idInstitucion]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Institucion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idInstitucion]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Institucion model.
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
     * Finds the Institucion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Institucion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Institucion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
