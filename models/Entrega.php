<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega".
 *
 * @property int $idEntrega
 * @property string $fecha
 * @property int $cantidad
 * @property string $observacion
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
            [['fecha', 'cantidad','idInstitucion'], 'required'],
            [['cantidad'], 'integer'],
            [['fecha'], 'safe'],
            [['observacion'], 'string', 'max' => 300],
            [['cantidad'],'number','min'=>1,'max'=>1000],
            [['idProducto'], 'exist', 'skipOnError' => true,
             'targetClass' => Producto::className(),
             'targetAttribute' => ['idProducto' => 'idProducto']],
            [['idInstitucion'], 'exist', 'skipOnError' => true,
             'targetClass' => Institucion::className(),
             'targetAttribute' => ['idInstitucion' => 'idInstitucion']],
            [['observacion'], 'default', 'value' => ''],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEntrega' => 'Id Entrega',
            'idInstitucion' => 'Institucion',
            'idProducto' => 'Id Producto',
            'fecha' => 'Fecha',
            'cantidad' => 'Cantidad Entregada',
            'observacion' => 'Observación',
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
