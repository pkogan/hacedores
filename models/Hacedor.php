<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hacedor".
 *
 * @property int $idHacedor
 * @property int $idUsuario
 * @property string $institucion
 * @property int $cantidadMaquinas
 * @property string $materialImprimir
 * @property string $link
 *
 * @property Usuario $idUsuario0
 * @property Modelo[] $modelos
 */
class Hacedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hacedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'institucion', 'cantidadMaquinas', 'materialImprimir', 'link'], 'required'],
            [['idUsuario', 'cantidadMaquinas'], 'integer'],
            [['institucion', 'materialImprimir', 'link'], 'string', 'max' => 300],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idHacedor' => 'Id Hacedor',
            'idUsuario' => 'Id Usuario',
            'institucion' => 'Institucion',
            'cantidadMaquinas' => 'Cantidad Maquinas',
            'materialImprimir' => 'Material Imprimir',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['idHacedor' => 'idHacedor']);
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }

    /**
     * Gets query for [[Modelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['idHacedor' => 'idHacedor']);
    }

    /**
       Buscar el hacedor correspondiente al usuario dado.
     */
    public function por_usuario($user_id){
        return Hacedor::find()
                 ->where(['idUsuario' => $user_id])
                 ->one();
    } // por_usuario

    /**
     */
    public function getProductos(){
        return $this->hasMany(Producto::className(), ['idHacedor' => 'idHacedor']);
    } // getProductos

    
    /**
     */
    public function getUsuario(){
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    } // getUsuario
    
    /**
     */
    public function getNombre(){
        $nombre = $this->usuario->nombreUsuario;
        if (($nombre == null) or ($nombre == '')){
            $nombre = $this->apellidoNombre;
        }
        if (($nombre == null) or ($nombre == '')){
            $nombre = $this->mail;
        }
        if (($nombre == null) or ($nombre == '')){
            $nombre = 'Id: ' . $this->idHacedor . " (sin nombre)";
        }
        return $nombre;
    } // getNombre

    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idProducto' => 'idProducto'])
            ->via('productos');
    }
    
    public function getSumproductos()
    {
        return $this->getProductos()->sum('producto.cantidad');
    }
    
    public function getSumentregada()
    {
        return $this->getEntregas()->sum('entrega.cantidad');
    }
    
    public function getStock(){
        return $this->getSumproductos()-$this->getSumentregada();
    }
    
    /**
     */
    public function cant_productos(){
        $cant = 0;
        foreach ($this->productos as $prod){
            $cant += $prod->cantidad;
        }
        return $cant;
    } // cant_productos

    /**
     */
    public function cant_entregas(){
        $cant = 0;
        foreach ($this->productos as $prod){
            $cant += $prod->cant_entregas();
        }
        return $cant;
    } // cant_entregas

    /**
     */
    public function stock_total(){
        $cant = 0;
        foreach ($this->productos as $prod){
            $cant += $prod->stock();
        }
        
        return $cant;
    } // stock

    /**
       Para más eficiencia, calcular los siguientes totales:
       - Cant. de productos producidos.
       - Cant. de productos en stock.
       - Cant. de producots entregados.

       @return {array} Un arreglo de `['producidos' => {int}, 
         'stock' => {int}, 'entregas' => {int}]`.
     */
    public function datos_prod(){
        $producidos = 0;
        $stock = 0;
        $entregas = 0;

        foreach ($this->productos as $prod){
            $producidos += $prod->cantidad;
            $stock += $prod->stock;
            $entregas += $prod->cant_entregas();
        }

        return [
            'producidos' => $producidos,
            'stock' => $stock,
            'entregas' => $entregas
        ];
    } // datos_prod
}
