<?php

namespace app\controllers;

use Yii;
use app\models\Registro;
use app\models\RegistroSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * RegistroController implements the CRUD actions for Registro model.
 */
class RegistroController extends Controller {

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
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'mapa', 'update', 'delete', 'create', 'resumen'],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['mapa', 'resumen'],
                        'roles' => ['?'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['index', 'view', 'mapa', 'resumen'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionMapa() {

        $query = Registro::find()->joinWith('idCiudad0');
        $query->groupBy(['ciudad.idCiudad', 'ciudad.ciudad', 'centroide_lat', 'centroide_lon']);
        $query->select(['ciudad.idCiudad', 'ciudad.ciudad', 'centroide_lat', 'centroide_lon', 'Count(*) as voluntarios', 'Sum(impresores) as impresoras',
            'Sum(PLA) as PLA', 'Sum(ABS) as ABS', 'Sum(PETG) as PETG', 'Sum(FLEX) as FLEX', 'Sum(HIPS) as $HIPS']);
        $registros = $query->asArray()->all();
        return $this->render('mapa', [
                    'registros' => $registros
        ]);
    }

    public function actionResumen() {
        $searchModel = new RegistroSearch();
        $dataProvider = $searchModel->searchResumen(Yii::$app->request->queryParams);
        $total = $searchModel->totalResumen(Yii::$app->request->queryParams);
        //print_r($total);exit;
        return $this->render('resumen', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'total' => $total,
        ]);
    }

    /**
     * Lists all Registro models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RegistroSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Registro model.
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
     * Creates a new Registro model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Registro();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRegistro]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Registro model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idRegistro]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Registro model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Registro model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Registro the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Registro::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRecuperar2($token) {
        
         $modelRegistro = Registro::find()
                        ->where(['token'=>$token])
                        ->one();
                if (!is_null($modelRegistro)) {
                    /********************/
                    //1- Mostrar formulario de clave y reclave
                    //2- en el Post Crear el usuario si no existe actualizar la Clave, Loguearlo
                    //y Mandarlo a que actualice su registro 
                }else{
                    throw new \yii\base\UserException('Error Token');
                }
    }
    
    
    public function actionRecuperar() {

        $model = new \app\models\Registro();    //carga del modelo para utilizarlo luego
        $model->mail = '';
        print_r(\Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post())) {// si se realizo un submit del boton guardar
            //print_r($model->email);
            if (!$model->mail == '') {
                $email = '' . $model->mail;
                
                $modelRegistro = Registro::find()
                        ->where('mail="' . $model->mail . '"')
                        ->one();
                if (!is_null($modelRegistro)) {

                    $nuevaClave = substr(md5(time()), 0, 6);
                    /* Agrego token y dirección a Registro */
                    print_r($modelRegistro);

                    $modelRegistro->token = Yii::$app->getSecurity()->generatePasswordHash($nuevaClave);
                    if ($modelRegistro->save(false)) {

                        Yii::$app->mailer->compose()
                                ->setFrom('hornero@fi.uncoma.edu.ar')
                                ->setTo($model->mail)
                                ->setSubject('Recuperar Contraseña sistema hacedores')
                                //->setTextBody('probando')
                                ->setHtmlBody('Estomadxs, '.$modelRegistro->apellidoNombre.
                                        ' ingrese al siguiente '.\yii\helpers\Html::a('link', \yii\helpers\Url::base('http').'?r=registro/recuperar2&token='.$modelRegistro->token).' para Cargar Pructos, Entregas y Actualizar Stock de Material.')
                                ->send();

                        //$modelRegistro->enviarMail("Recuperar Contraseña de hacedores ", "");
                        throw new \yii\base\UserException('Se ha enviado el mail. Revise su correo');
                    } else {
                        throw new \yii\base\UserException('no pudo guardar');
                    }
                } else {
                    throw new \yii\base\UserException('el Correo no existe');
                }
            }
        }
        return $this->render('recuperar', ['model' => $model]);
    }

}
