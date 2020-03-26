<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserva".
 *
 * @property int $idReserva
 * @property int|null $idProducto
 * @property int|null $idUsuario
 *
 * @property Usuario $idUsuario0
 * @property Producto $idProducto0
 */
class Reserva extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserva';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProducto', 'idUsuario', 'cantidad'], 'integer'],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
            [['idProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['idProducto' => 'idProducto']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idReserva' => 'Id Reserva',
            'idProducto' => 'Id Producto',
            'idUsuario' => 'Id Usuario',
            'cantidad' => 'Cantidad',
        ];
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
     * Gets query for [[IdProducto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto0()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'idProducto']);
    }
    
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'idProducto']);
    }

    /**
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
    
}
