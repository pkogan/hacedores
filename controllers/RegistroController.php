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
                'ruleConfig' => [
                    'class' => \app\models\AccessRule::className(),
                ],
                'only' => ['index', 'view', 'mapa', 'update', 'delete', 'create', 'resumen'],
                'rules' => [
                        [
                        'allow' => true,
                        'actions' => ['mapa', 'resumen', 'create'],
                        'roles' => ['?', '@'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['@'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['index', 'view', 'mapa'],
                        'roles' => [\app\models\Rol::ROL_ADMIN, \app\models\Rol::ROL_GESTOR],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => [\app\models\Rol::ROL_ADMIN],
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

            return $this->envioMail($model);
            //return $this->redirect(['view', 'id' => $model->idHacedor]);
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
        if (Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN ||
                Yii::$app->user->identity->idUsuario == $model->idUsuario) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['/site']);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new \yii\base\UserException('No tiene los permisos para realizar esta operación');
        }
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
        if (($model = Registro::find()->joinWith('idCiudad0')->joinWith('productos.entregas')->where('hacedor.idHacedor='.$id)->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRecuperar2($token) {


        $modelRegistro = Registro::find()
                ->where('token="' . $token . '"')
                ->one();
        /* @var $modelRegistro app\models\Registro */
        if (!is_null($modelRegistro)) {

            /*             * ***************** */
            /* si no existe el usuario asignado al Registro se crea */
            if (is_null($modelRegistro->idUsuario)) {
                $model = new \app\models\Usuario();
                $model->nombreUsuario = $modelRegistro->mail;
                $model->idRol = \app\models\Rol::ROL_MAKER;
                $model->clave = substr(md5(time()), 0, 6);
                if ($model->save()) {
                    $modelRegistro->idUsuario = $model->idUsuario;
                    if (!$modelRegistro->save()) {
                        print_r($modelRegistro->errors);
                        exit();
                        throw new \yii\base\UserException('No se actualizó el registro');
                    }
                } else {
                    throw new \yii\base\UserException('No se creó el usuario');
                }
            } else {
                $model = $modelRegistro->idUsuario0;
            }
            //2- en el Post Crear el usuario si no existe actualizar la Clave, Loguearlo
            //y Mandarlo a que actualice su registro 
            //1- Mostrar formulario de clave y reclave
            //$model->nombreUsuario=$modelRegistro->mail;
            $modelForm = new \app\models\ActualizarclaveForm();
            $modelForm->direccion = $modelRegistro->direccion;
            if ($modelForm->load(Yii::$app->request->post()) && $modelForm->validate()) {

                $model->clave = $modelForm->clave;
                if (!$model->save()) {
                    throw new \yii\base\UserException('No se puede actualizar la clave del usuario');
                }
                $modelRegistro->direccion = $modelForm->direccion;
                if (!$modelRegistro->save()) {
                    //print_r($modelRegistro->errors);exit;
                    throw new \yii\base\UserException('No se puede actualizar la Dirección del Registro');
                }
                //limpio token para futuros casos????
                $modelRegistro->token = null; //XXXX
                if (!$modelRegistro->save()) {
                    throw new \yii\base\UserException('no pudo limpiar token');
                }
                //login
                $loginForm = new \app\models\LoginForm();
                $loginForm->username = $model->nombreUsuario;
                $loginForm->password = $modelForm->clave;
                $loginForm->login();
                //Yii::$app->user->login($model->nombreUsuario, 3600*24*30 );
                return $this->goHome();
            } else {
                return($this->render('formclave', [
                            'model' => $modelForm,
                ]));
            }
        } else {
            throw new \yii\base\UserException('Error Token');
        }
    }

    public function actionRecuperar() {
        $model = new \app\models\RecuperarclaveForm();    //carga del modelo para utilizarlo luego
        $model->mail = '';
        //print_r(\Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post())) {// si se realizo un submit del boton guardar
            //print_r($model->email);
            if (!$model->mail == '') {

                $modelRegistro = Registro::find()
                        ->where('mail="' . $model->mail . '"')
                        ->one();
                if (!is_null($modelRegistro)) {
                    return $this->envioMail($modelRegistro);
                } else {
                    $model->addError('mail', 'el Correo es incorrecto o no está cargado. Si el problema persiste vuelva a registrarse');
                }
            }
        }
        return $this->render('recuperar', ['model' => $model]);
    }

    protected function envioMail($modelRegistro) {

        $nuevaClave = substr(md5(time()), 0, 6);
        /* Agrego token y dirección a Registro */
        //print_r($modelRegistro);

        $modelRegistro->token = substr(Yii::$app->getSecurity()->generatePasswordHash($nuevaClave), 0, 32);
        if ($modelRegistro->save(false)) {

            Yii::$app->mailer->compose()
                    ->setFrom('hornero@fi.uncoma.edu.ar')
                    ->setTo($modelRegistro->mail)
                    ->setSubject('Actualización del registro de Makers de la Patagonia Norte')
                    ->setHtmlBody('Estomadx, ' . $modelRegistro->apellidoNombre .
                            ', este correo es enviado por el sistema hacedores.fi.uncoma.edu.ar (registro de Makers de la Patagonia Norte). Ingrese al siguiente ' . \yii\helpers\Html::a('link', \yii\helpers\Url::base('http') . '?r=registro/recuperar2&token=' . $modelRegistro->token) .
                            ' para cargar sus Productos Impresos, Entregas y Actualizar Stock de Material.  ')
                    ->send();


            return $this->render('mensaje', ['mensaje' => 'Se le ha enviado un Correo Electrónico. Revise su casilla']);
        } else {
            throw new \yii\base\UserException('no pudo guardar');
        }
    }

}
