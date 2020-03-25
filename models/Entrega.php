<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "entrega".
 *
 * @property int $idEntrega
 * @property int $idAsignacion
 * @property string $fecha
 * @property int $cantidadEntregada
 * @property string $imagen
 *
 * @property Asignacion $idAsignacion0
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
            [['idAsignacion', 'fecha', 'cantidadEntregada', 'imagen'], 'required'],
            [['idAsignacion', 'cantidadEntregada'], 'integer'],
            [['fecha'], 'safe'],
            [['imagen'], 'string', 'max' => 300],
            [['idAsignacion'], 'exist', 'skipOnError' => true, 'targetClass' => Asignacion::className(), 'targetAttribute' => ['idAsignacion' => 'idAsignacion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idEntrega' => 'Id Entrega',
            'idAsignacion' => 'Id Asignacion',
            'fecha' => 'Fecha',
            'cantidadEntregada' => 'Cantidad Entregada',
            'imagen' => 'Imagen',
        ];
    }

    /**
     * Gets query for [[IdAsignacion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdAsignacion0()
    {
        return $this->hasOne(Asignacion::className(), ['idAsignacion' => 'idAsignacion']);
    }
}
