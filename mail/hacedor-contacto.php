<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**
   @var $this \yii\Web\View
   @var $message \yii\mail\MessageInterface
   @var $contacto app\models\Contacto
 */
$message->setSubject('Mensaje de ' . $mensaje->from_mail);
?>

<div>
  <h1> Le han enviado un mensaje desde la página </h1>
  <?= Html::a('hacedores.fi.uncoma.edu.ar', ['/'], []) ?>.</p>

  <p>Desde:</p>
  <p> <?= $mensaje->from_mail ?> ( <?= $mensaje->from_tel ?> )</p>
  
  <p>Asunto: <?= $mensaje->subject ?></p>
  <p>Contenido:</p>

  <code>
    <?= $mensaje->texto ?>
  </code>

</div>
