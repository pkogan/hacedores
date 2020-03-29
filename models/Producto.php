<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idProducto
 * @property int $idHacedor
 * @property int $idModelo
 * @property int|null $cantidad
 *
 * @property Hacedor $idHacedor0
 * @property Modelo $idModelo0
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idHacedor', 'idModelo','cantidad'], 'required'],
            [['idHacedor', 'idModelo', 'cantidad'], 'integer'],
            [['cantidad'],'number','min'=>1,'max'=>1000],
            [['idHacedor'], 'exist', 'skipOnError' => true, 'targetClass' => Hacedor::className(), 'targetAttribute' => ['idHacedor' => 'idHacedor']],
            [['idModelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['idModelo' => 'idModelo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProducto' => 'Producto',
            'idHacedor' => 'Maker',
            'idModelo' => 'Modelo',
            'cantidad' => 'Cantidad',
        ];
    }

    /**
     * Gets query for [[IdHacedor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdHacedor0()
    {
        return $this->hasOne(Hacedor::className(), ['idHacedor' => 'idHacedor']);
    }

    /**
     * Gets query for [[IdModelo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdModelo0()
    {
        return $this->hasOne(Modelo::className(), ['idModelo' => 'idModelo']);
    }

    /**
     */
    public function getModelo(){
        return $this->hasOne(Modelo::className(), ['idModelo' => 'idModelo']);
    } // getModelo

    /**
     */
    public function getHacedor(){
        return $this->hasOne(Hacedor::className(), ['idHacedor' => 'idHacedor']);
    } // getHacedor

    /**
       Retornar una representación en string del producto.
       @return {string}
     */
    public function short_string(){
        return $this->hacedor->nombre . ":" .
          $this->modelo->nombre . " (" .
          $this->stock . ")";
    } // short_string

    /**
     */
    public function getEntregas(){
        return $this->hasMany(Entrega::className(), ['idProducto' => 'idProducto']);
    } // getEntregas

    /**
     */
    public function cant_entregas(){
        $cant = 0;
        foreach ($this->entregas as $entrega){
            $cant += $entrega->cantidad;
        }
        return $cant;
    } // cant_entregas

    public function getSumentregas(){
        $this->getEntregas()->sum('entrega.cantidad');
    }
           
    /**
       La cantidad disponible de este producto.

       @return {integer}
     */
    public function getStock(){
        
        return $this->cantidad - $this->cant_entregas();
    } // getStock

    /**
       Este producto, ¿tiene alguna entrega realizada?

       @return {boolean}
     */
    public function tiene_entregas(){
        return count($this->entregas) != 0;
    } // tiene_entregas
}
