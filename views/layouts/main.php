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
            ['label' => 'Tus productos',
             'url' => ['/producto']],
            ['label' => 'Resumen', 'url' => ['/registro/resumen']],
            ['label' => 'Mapa', 'url' => ['/registro/mapa']],
            ['label' => 'Acerca de', 'url' => ['/site/about']],
            
            ['label' => 'Registro', 'url' => ['/registro'],'visible' => !Yii::$app->user->isGuest ],
            /*['label' => 'Carrera', 'url' => ['/carrera'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->idRol== \app\models\Rol::ROL_ADMIN],
            ['label' => 'Categoria', 'url' => ['/categoria'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->idRol== \app\models\Rol::ROL_ADMIN],
            ['label' => 'Punto', 'url' => ['/punto'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->idRol== \app\models\Rol::ROL_ADMIN],
             */
           
            ['label' => 'Usuarios', 'url' => ['/usuario'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->idRol== \app\models\Rol::ROL_ADMIN],          
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
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
