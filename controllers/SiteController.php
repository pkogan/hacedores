<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Rol;
use app\models\Hacedor;
use app\models\ProductoSearch;
use app\models\EntregaSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new \app\models\RegistroSearch();
        $total = $searchModel->totalResumen(null);

        $puede['ver_reservas'] = $this->tiene_roles(
            [Rol::ROL_ADMIN, Rol::ROL_GESTOR]);
        $puede['ver_productos'] = $this->tiene_roles(
            [Rol::ROL_ADMIN, Rol::ROL_GESTOR, Rol::ROL_MAKER]
        );
        
        if ($this->tiene_roles([Rol::ROL_ADMIN, Rol::ROL_MAKER])){
            $hacedor = Hacedor::por_usuario(Yii::$app->user->identity->idUsuario);
            
            $productoSearch = new ProductoSearch();
            $params = Yii::$app->request->queryParams;
            $params['ProductoSearch']['idHacedor'] = $hacedor->idHacedor;
            $productoProvider = $productoSearch->search($params);

            $entregaSearch = new EntregaSearch();
            $params = Yii::$app->request->queryParams;
            $params['EntregaSearch']['idHacedor'] = $hacedor->idHacedor;
            $entregaProvider = $entregaSearch->search($params);


            
            return $this->render('index-hacedores', [
                'hacedor' => $hacedor,
                'puede' => $puede,
                'total' => $total,
                'productoSearch' => $productoSearch,
                'productoProvider' => $productoProvider,
                'entregaSearch' => $entregaSearch,
                'entregaProvider' => $entregaProvider,
            ]);
        }else{
            return $this->render('index', [
                'puede' => $puede,
                'total' => $total,
            ]);
        }

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    protected function tiene_roles($rol){
        return in_array(Yii::$app->user->identity->idRol, $rol);
    }
}
