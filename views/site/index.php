<?php

use yii\helpers\Html;
use app\assets\IntrojsAsset;
IntrojsAsset::register($this);

/* @var $this yii\web\View */

$this->title = 'Registro de Makers';
?>
<div class="site-index">
          <?= $this->render('_carousel_modelos.php'); ?>


    <div class="jumbotron">

        <h1>Registro de Makers</h1>
        <row>
            <div class="col-md-3">
                <h3><?= Html::a('<span class=" glyphicon glyphicon-map-marker"></span>'. $total['voluntarios'] , ['registro/mapa'], ['class' => 'btn btn-success']) ?><br/> Voluntarios</h3>
            </div>
            <div class="col-md-3">
                <h3><?= Html::a('<span class="glyphicon glyphicon-tasks"> </span>'. $total['impresoras'], ['registro/resumen'], ['class' => 'btn btn-success']) ?> <br/> Impresoras</h3>
            </div>
            <div class="col-md-3">
                <h3><?= Html::a('<span class="glyphicon glyphicon-cog"></span>'.$total['productos1'], ['registro/resumen'], ['class' => 'btn btn-success']) ?> <br/> Máscaras Impresas</h3>
            </div>
            <div class="col-md-3">
                    <h3><?= Html::a('<span class="glyphicon glyphicon-send"> </span>'. $total['entregados'], ['entrega/resumen'], ['class' => 'btn btn-success']) ?><br/>  Máscaras  Entregadas</h3>
            </div>
        </row>
        <br/>
         


    <p class="lead">El objetivo de esta aplicación es afrontar la demanda de insumos impresos en impresoras 3d para combatir el COVID-19, de forma colaborativa, juntando fuerzas de grupos y redes de makers.</p>
    <p class="lead"><?= Html::a('Login/Registro', ['site/login'], ['class' => 'btn btn-success']) ?> <a class="btn btn-success" href="#modelo">Descargar Modelo</a>
        <?php //echo Html::a('Ver Makers', ['registro/mapa'], ['class' => 'btn btn-success']) ?>
       <?php //echo Html::a('Ver Producción', ['registro/resumen'], ['class' => 'btn btn-success']) ?>  </p>
 
</div>

        <!--<p>
          <?php
          if ($puede['ver_reservas']){
              echo Html::a('Reservas', ['reserva/index'],
                          ['class' => 'btn btn-default',
                           'data-hints' =>
                               'Vea las reservas realizadas, solicite productos que ya fueron creados.']);
              echo " ";
          }
          if ($puede['ver_productos']){
              echo Html::a('Productos', ['producto/index'],
                          ['class' => 'btn btn-default']);
          }
          ?>
        </p>-->
            

    </div>
<div class="body-content">

    <div class="row">
        <div class="col-lg-4">
            <h2 id="modelo">Modelo Mascara MinSalud</h2>
            <p>Es un diseño que ha sido revisado y mejorado en función de lo solicitado por el Ministerio de Salud de Neuquén.

Compartimos dos archivos STL para la fabricación de la Máscara de Protección Facial y un Manual con un plano y recomendaciones para la fabricación.
</p>
<ul>
    <li><a href="img/20200326-MascaraMinSalud.stl">20200326-MascaraMinSalud.stl</a> </li>
    <li><a href="img/20200326-MascaraMinSalud2.stl">20200326-MascaraMinSalud2.stl</a></li>
    <li><a href="img/Manual.pdf">Manual y Recomendaciones</a></li>
</ul>
<p>Este producto, tiene el objetivo de preservar y proteger a todas las personas del sistema de salud que ponen el cuerpo de manera directa las 24 h en este momento que nos toca vivir a todos/as. Y esto que hemos logrado entre todos, es el esfuerzo de muchas horas de trabajo de los equipos técnicos y de coordinación de las instituciones y de especialistas, emprendedores y empresas de toda la comunidad.
Les pedimos, mientras tanto, se extremen las medidas de cuidado, en el sentido más amplio del término, durante el proceso de producción y entrega. Establezcan los cuidados necesarios de cada uno/a de ustedes. Cuidemos la manipulación y preservemos la higiene producto.

            </p>
            

        </div>
        <div class="col-lg-4">
            <h2>Registro de Makers</h2>

            <p> La fuente de datos de makers se obtiene de un registro realizado por tres entidades</p>
            <ul>
                <li>El Gobierno de la Provincia de Neuquén y Centro PyME-ADENEU en el siguiente <a class="btn btn-default" href="https://forms.gle/hEqG9YNnMjGduYEv6 ">Formulario &raquo;</a></li>
                <li>La red de makers de San Martín de Los Andes <a class="btn btn-default" href="https://web.facebook.com/impresoresneuquen/">Facebook &raquo;</a></li>
                <li>Universidad Nacional de Río Negro en el siguiente <a class="btn btn-default" href="https://forms.gle/Qzgt5qZaDxsjH7ML8">Formulario &raquo;</a></li>
                
            </ul>
            
        </div>
        <div class="col-lg-4">
            <h2>Otras fuentes</h2>


            <p> La fuente de datos de localidades y georreferenciamiento se obtiene de </p>
            <p><a class="btn btn-default" href="https://datos.gob.ar/">Datos Nacionales &raquo;</a></p>
            <p> Las imágenes se obtienen de</p>
            <p><a class="btn btn-default" href="https://www.openstreetmap.org/">OpenStreetMap &raquo;</a>

                <p> Las imágenes se obtienen de</p>
                <p><a class="btn btn-default" href="https://www.openstreetmap.org/">OpenStreetMap &raquo;</a>


        </div>
        
    </div>


</div>
</div>
<script>
    $('.counter-count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 5000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
