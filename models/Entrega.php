<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega".
 *
 * @property int $idEntrega
 * @property string $fecha
 * @property int $cantidad
 * @property string $imagen
 *
 */
class Entrega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entrega';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha', 'cantidad'], 'required'],
            [['cantidad'], 'integer'],
            [['fecha'], 'safe'],
            [['imagen'], 'string', 'max' => 300],
            [['idProducto'], 'exist', 'skipOnError' => true,
             'targetClass' => Producto::className(),
             'targetAttribute' => ['idProducto' => 'idProducto']],
            [['idInstitucion'], 'exist', 'skipOnError' => true,
             'targetClass' => Institucion::className(),
             'targetAttribute' => ['idInstitucion' => 'idInstitucion']],
            [['imagen'], 'default', 'value' => ''],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEntrega' => 'Id Entrega',
            'idInstitucion' => 'Id Institucion',
            'idProducto' => 'Id Producto',
            'fecha' => 'Fecha',
            'cantidad' => 'Cantidad Entregada',
            'imagen' => 'Imagen',
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducto()
    {
        return $this->hasOne(Producto::className(), ['idProducto' => 'idProducto']);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Institucion::className(), ['idInstitucion' => 'idInstitucion']);
    }

    /**
     */
    public function getHacedor(){
        return $this->hasOne(Hacedor::className(), ['idHacedor' => 'idHacedor'])
              ->viaTable('producto', ['idProducto' => 'idProducto']);
    } // getHacedor

    /**
     */
    public function getIdHacedor(){
        return $this->hacedor->idHacedor;
    } // getIdHacedor
}
