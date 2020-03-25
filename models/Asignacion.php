<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asignacion".
 *
 * @property int $idAsignacion
 * @property int $idPedido
 * @property int $idHacedor
 * @property int $cantidadAsignada
 * @property int $cantidadCreada
 *
 * @property Hacedor $idHacedor0
 * @property Pedido $idPedido0
 * @property Entrega[] $entregas
 */
class Asignacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asignacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPedido', 'idHacedor'], 'required'],
            [['idPedido', 'idHacedor', 'cantidadAsignada', 'cantidadCreada'], 'integer'],
            [['idHacedor'], 'exist', 'skipOnError' => true, 'targetClass' => Hacedor::className(), 'targetAttribute' => ['idHacedor' => 'idHacedor']],
            [['idPedido'], 'exist', 'skipOnError' => true, 'targetClass' => Pedido::className(), 'targetAttribute' => ['idPedido' => 'idPedido']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idAsignacion' => 'Id Asignacion',
            'idPedido' => 'Id Pedido',
            'idHacedor' => 'Id Hacedor',
            'cantidadAsignada' => 'Cantidad Asignada',
            'cantidadCreada' => 'Cantidad Creada',
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
     * Gets query for [[IdPedido0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdPedido0()
    {
        return $this->hasOne(Pedido::className(), ['idPedido' => 'idPedido']);
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idAsignacion' => 'idAsignacion']);
    }
}
