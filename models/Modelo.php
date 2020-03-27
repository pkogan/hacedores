<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modelo".
 *
 * @property int $idModelo
 * @property string $nombre
 * @property string $descripcion
 * @property int $idHacedor
 * @property string|null $imagen
 * @property string|null $link
 *
 * @property Hacedor $idHacedor0
 * @property Pedido[] $pedidos
 */
class Modelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modelo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'idHacedor'], 'required'],
            [['descripcion'], 'string'],
            [['idHacedor'], 'integer'],
            [['nombre', 'imagen', 'link'], 'string', 'max' => 300],
            [['idHacedor'], 'exist', 'skipOnError' => true, 'targetClass' => Hacedor::className(), 'targetAttribute' => ['idHacedor' => 'idHacedor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idModelo' => 'Id Modelo',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'idHacedor' => 'Id Hacedor',
            'imagen' => 'Imagen',
            'link' => 'Link',
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
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idModelo' => 'idModelo']);
    }

    /**
     */
    public function getHacedor(){
        return $this->hasOne(Hacedor::className(),
                       ['idHacedor' => 'idHacedor']);        
    } // getHacedor

    /**
       Devolver los productos de este modelo.
     */
    public function getProducidos(){
        return $this->hasMany(Producto::className(),
                        ['idModelo' => 'idModelo']);
    } // getProducidos
    
    /**
       Retornar la cantidad disponible.
     */
    public function getDisponible(){
        $cant = 0;
        $prods = $this->producidos;
        
        foreach ($prods as $producto){
            $cant += $producto->cantidad;
        }

        return $cant;
    } // getDisponible
}
