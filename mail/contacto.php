<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**
   @var $this \yii\Web\View
   @var $message \yii\mail\MessageInterface
   @var $contacto app\models\Contacto
 */
$message->setSubject('Contacto recibido');
?>

<div>
  <h1> Se ha recibido un mensaje de contacto </h1>
  <p><?= $contacto->nombre ?> ha escrito para contactarse desde la página
    <?= Html::a('hacedores.fi.uncoma.edu.ar', ['/'], []) ?>.</p>

  <?php
  if ($contacto->con_caso){
      echo "<b>ADVERTENCIA: Indica que posee un caso confirmado.</b>";
  }
  ?>
    
  <p> El contenido puede verse haciendo clic
    <?= Html::a('aquí', ['contacto/view', 'id' => $contacto->id], []) ?>
    o copiando la siguiente dirección de enlace:</p>
  
  <code><?= Url::to(['contacto/view', 'id' => $contacto->id]) ?></code>

  <hr/>
  <p>Datos:</p>
  <p>Tel.: <?= $contacto->tel ?></p>
  <p>Institucion: <?= $contacto->institucion->nombre ?></p>
  <?php if ($contacto->con_caso){ ?>
    <b>Caso confirmado: Sí.</b>
  <?php }else{ ?>
    <p>Caso confirmado: No.</p>
  <?php } ?>
  <p>Más información: <?= $contacto->mas_info ?></p>
</div>
