<?php

use yii\db\Migration;

/**
 * Class m200326_142153_tablas_iniciales
 * 
 * Migración para crear las tablas iniciales. 
 *
 * TODO: Por el momento se deja comentado porque se importa un SQL. 
 * Más tarde deberá probarse para generar correctamente las migraciones.
 */
class m200326_142153_tablas_iniciales extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /*
           $this->createTable('asignacion', [
           'idAsignacion' => $this->integer()->primaryKey(),
           'idPedido' => $this->integer(),
           'idHacedor' => $this->integer(),
           'cantidadAsignada' => $this->integer(),
           'cantidadCreada' => $this->integer()
           ], 'ENGINE InnoDB');

           $this->createTable('ciudad', [
           'categoria' => $this->string(45),
           'centroide_lat' => $this->string(17),
           'centroide_lon' => $this->string(17),
           'departamento_id' => $this->string(5),
           'departamento_nombre' => $this->string(34),
           'fuente' => $this->string(5),
           'idCiudad' => $this->bigInteger()->primaryKey(), 
           'localidad_censal_id' => $this->integer(),
           'localidad_censal_nombre' => $this->string(80),
           'municipio_id' => $this->string(6),
           'municipio_nombre' => $this->string(38),
           'ciudad' => $this->string(45),
           'idProvincia' => $this->integer(),
           'provincia_nombre' => $this->string(53),
           // 'punto' point DEFAULT NULL
           'punto' => $this->binary(25)

           ], 'ENGINE InnoDB');

           $this->createTable('entrega', [
           'idEntrega' => $this->integer()->primaryKey(), 
           'idAsignacion' => $this->integer(),
           'fecha' => $this->date(),
           'cantidadEntregada' => $this->integer(),
           'imagen' => $this->string(300)
           ], 'ENGINE InnoDB');

           $this->createTable('estado', [
           'idEstado' => $this->integer()->primaryKey(),
           'estado' => $this->string(50)
           ], 'ENGINE InnoDB');

           $this->createTable('hacedor', [
           'idHacedor' => $this->integer()->primaryKey(),
           'idUsuario' => $this->integer(),
           'institucion' => $this->string(300),
           'cantidadMaquinas' => $this->integer(),
           'materialImprimir' => $this->string(300),
           'link' => $this->string(300)
           ], 'ENGINE InnoDB');

           $this->createTable('modelo', [
           'idModelo' => $this->integer()->primaryKey(),
           'nombre' => $this->string(300),
           'descripcion' => $this->text()
           'idHacedor' => $this->integer(),
           'imagen' => $this->string(300),
           'link' => $this->string(300)
           ], 'ENGINE InnoDB');

           $this->createTable('pedido', [
           'idPedido' => $this->integer()->primaryKey(),
           'idSolicitante' => $this->integer(),
           'fecha' => $this->date(),
           'observacion' => $this->string(300),
           'imagen' => $this->string(200),
           'idModelo' => $this->integer(),
           'cantidad' => $this->integer(),
           'idEstado' => $this->integer()
           ], 'ENGINE InnoDB');

           $this->createTable('provincia', [
           'idProvincia' => $this->integer()->primaryKey(),
           'provincia' => $this->string()
           ], 'ENGINE InnoDB');

           $this->createTable('registro', [
           'idRegistro' => $this->integer()->primaryKey(),
           'marca' => $this->string(19),
           'mail' => $this->string(35),
           'apellidoNombre' => $this->string(32),
           'telefono' => $this->$this->bigInteger(),
           'Localidad' => $this->string(23),
           'impresores' => $this->integer(),
           'modelos' => $this->string(58),
           'tipoFilamento' => $this->string(63),
           'stock' => $this->string(67),
           'recursos' => $this->string(165),
           'contacto' => $this->string(2),
           'provincia' => $this->string(23),
           'Comentario' => $this->string(347),
           'impresoras' => $this->string(1),
           'PLA' => $this->string(2),
           'ABS' => $this->string(1),
           'PETG' => $this->string(1),
           'FLEX' => $this->string(1),
           'HIPS' => $this->string(1),
           'ciudad' => $this->string(23),
           'idCiudad' => $this->bigInteger(11) 
           ], 'ENGINE InnoDB');

           $this->createTable('rol', [
           'idRol' => $this->integer(11)->primaryKey(),
           'nombre' => $this->string(100)  
           ], 'ENGINE InnoDB');

           $this->createTable('solicitante', [
           'idSolicitante' => $this->integer(11)->primaryKey(),
           'idUsuario' => $this->integer(11),
           'Intitucion' => $this->string(300) 

           ], 'ENGINE InnoDB');

           $this->createTable('usuario', [
           'idUsuario' => $this->integer(11)->primaryKey(),
           'nombreUsuario' => $this->string(100),
           'clave' => $this->string(100),
           'mail' => $this->string(200),
           'idRol' => $this->integer(11),
           'telefono' => $this->string(200),
           'telegram' => $this->string(200),
           'idCiudad' => $this->bigInteger(11),
           'nombreApellido' => $this->string(300),
           'direccion' => $this->string(300)

           ], 'ENGINE InnoDB');

           
           // --------------------
           // Datos por fedecto
           // --------------------
           
           $h = new Estado;
           $h->idEstado = 1;
           $h->estado = 'Creado';
           $h->save();

           $h = new Estado;
           $h->idEstado = 2;
           $h->estado = 'En Producción';
           $h->save();
           
           $h = new Estado;
           $h->idEstado = 3;
           $h->estado = 'Entregado';
           $h->save();

           $rol = [
           1 => 'Admin',
           2 => 'Gestor',
           3 => 'Maker',
           4 => 'Solicitante'];

           foreach ($rol as $id => $nombre){
           $r = new Rol
           $r->idRol = $id;
           $r->nombre = $nombre
           $r->save();
           }

           $prov = [
           2 => 'Ciudad Autónoma de Buenos Aires',
           6 => 'Buenos Aires',
           10 => 'Catamarca',
           14 => 'Córdoba',
           18 => 'Corrientes',
           22 => 'Chaco',
           26 => 'Chubut',
           30 => 'Entre Ríos',
           34 => 'Formosa',
           38 => 'Jujuy',
           42 => 'La Pampa',
           46 => 'La Rioja',
           50 => 'Mendoza',
           54 => 'Misiones',
           58 => 'Neuquén',
           62 => 'Río Negro',
           66 => 'Salta',
           70 => 'San Juan',
           74 => 'San Luis',
           78 => 'Santa Cruz',
           82 => 'Santa Fe',
           86 => 'Santiago del Estero',
           90 => 'Tucumán',
           94 => 'Tierra del Fuego, Antártida e Islas del Atlántico ',
           ];

           foreach ($prov as $id => $nombre){
           $r = new Provincia
           $r->idProvincia = $id;
           $r->provincia = $nombre
           $r->save();
           }
         */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_142153_tablas_iniciales cannot be reverted.\n";

        return false;
    }

    /*
       // Use up()/down() to run migration code without a transaction.
       public function up()
       {

       }

       public function down()
       {
       echo "m200326_142153_tablas_iniciales cannot be reverted.\n";

       return false;
       }
     */
}
