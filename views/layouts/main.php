<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  </head>
  <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Inicio', 'url' => ['/site/index']],
                    ['label' => 'Actualizar Registro',
                     'url' => ['/registro/update','id'=> Yii::$app->user->identity->hacedor->idHacedor],
                     'visible' => !Yii::$app->user->isGuest
                            && Yii::$app->user->identity->idRol == \app\models\Rol::ROL_MAKER],                        
                    ['label' => 'Actualizar Producción', 'url' => ['/producto/agregar'],
                     'visible' => !Yii::$app->user->isGuest
                            && Yii::$app->user->identity->idRol == \app\models\Rol::ROL_MAKER],                        
                    ['label' => 'Productos', 'url' => ['/producto'],
                     'visible' => !Yii::$app->user->isGuest
                            && Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN],
                    
                    ['label' => 'Modelos',
                     'url' => ['/modelo'],
                     'visible' => !Yii::$app->user->isGuest
                            && Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN],
                    
                    ['label' => 'Mapa', 'url' => ['/registro/mapa']],
                    
                    ['label' => 'Producción', 'url' => ['/registro/resumen']],
                    ['label' => 'Registro',
                     'url' => ['/registro'],
                     'visible' => !Yii::$app->user->isGuest
                            && in_array(Yii::$app->user->identity->idRol,
                                       [\app\models\Rol::ROL_ADMIN,
                                        app\models\Rol::ROL_GESTOR])
                    ],
                    ['label' => 'Entregas', 'url' => ['/entrega'],
                     'visible' => !Yii::$app->user->isGuest
                            && in_array(Yii::$app->user->identity->idRol,
                                       [\app\models\Rol::ROL_ADMIN,
                                        \app\models\Rol::ROL_GESTOR])
                    ],
                    ['label' => 'Institucion', 'url' => ['/institucion'],
                     'visible' => !Yii::$app->user->isGuest
                            && in_array(Yii::$app->user->identity->idRol,
                                       [\app\models\Rol::ROL_ADMIN,
                                        app\models\Rol::ROL_GESTOR])],
                    ['label' => 'Pedidos (Entregas Gestor)', 'url' => ['/pedido'],
                     'visible' => !Yii::$app->user->isGuest
                            && in_array(Yii::$app->user->identity->idRol,
                                       [\app\models\Rol::ROL_ADMIN,
                                        app\models\Rol::ROL_GESTOR])],

                   /* [ 'label' => 'Usuario',
                      'items' => [*/
                          
                          ['label' => 'Usuarios', 'url' => ['/usuario'],
                           'visible' => !Yii::$app->user->isGuest
                                  && Yii::$app->user->identity->idRol == \app\models\Rol::ROL_ADMIN
                          ],
                    ['label' => 'Contacto', 'url' => ['/contacto/create'],
                     'visible' => Yii::$app->user->isGuest],
                        
                          ['label' => 'Acerca de', 'url' => ['/site/about']],
                          Yii::$app->user->isGuest ? (
                              ['label' => 'Login', 'url' => ['/site/login']]
                          ) : (
                              '<li>'
                            . Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>'
                          )
                      ],
                 /*   ],
                ],*/
            ]);
            NavBar::end();
            ?>

            <div class="container">
              <?=
              Breadcrumbs::widget([
                  'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              ])
              ?>
              <?= Alert::widget() ?>
              <?= $content ?>
            </div>
    </div>
    <div class="logos">
      <h5>Intituciones que son parte de este proyecto</h5>
      
      <!--    <img src="img/faif.png" alt="Facultad de Informática"/>
           <img width="70px" src="img/fain.png" alt="Facultad de Ingeniería"/> -->
      <img width="70px" src="img/uflo.png" alt="UFLO"/>
      <img src="img/unrn.png" alt="UNRN"/>
      <img src="img/utn.png" alt="UTN"/>
      <img src="img/uncoma.png" alt="UNCo"/>
      
      <img src="img/nqn.png" alt="Gobierno Provincia Neuquén"/> 
      <img src="img/cepyme.png" alt="CEPyme"/>
      <img src="img/minsalud.jpeg" alt="MinSalud"/>
      
    </div>

    <footer class="footer">
      
      <div class="container">
        <p class="pull-left">Licencia GPL-3.0  <span class="copyleft"> &copy;</span> Facultad de Informática - Universidad Nacional del Comahue <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
      </div>
      
      

    </footer>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>
