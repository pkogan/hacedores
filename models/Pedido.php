<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $idPedido
 * @property int $idSolicitante
 * @property string $fecha
 * @property string|null $observacion
 * @property string|null $imagen
 * @property int $idModelo
 * @property int $idEstado
 *
 * @property Asignacion[] $asignacions
 * @property Estado $idEstado0
 * @property Solicitante $idSolicitante0
 * @property Modelo $idModelo0
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idPedido', 'idSolicitante', 'fecha', 'idModelo', 'idEstado'], 'required'],
            [['idPedido', 'idSolicitante', 'idModelo', 'idEstado'], 'integer'],
            [['fecha'], 'safe'],
            [['observacion'], 'string', 'max' => 300],
            [['imagen'], 'string', 'max' => 200],
            [['idPedido'], 'unique'],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'idEstado']],
            [['idSolicitante'], 'exist', 'skipOnError' => true, 'targetClass' => Solicitante::className(), 'targetAttribute' => ['idSolicitante' => 'idSolicitante']],
            [['idModelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['idModelo' => 'idModelo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPedido' => 'Id Pedido',
            'idSolicitante' => 'Id Solicitante',
            'fecha' => 'Fecha',
            'observacion' => 'Observacion',
            'imagen' => 'Imagen',
            'idModelo' => 'Id Modelo',
            'idEstado' => 'Id Estado',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['idPedido' => 'idPedido']);
    }

    /**
     * Gets query for [[IdEstado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estado::className(), ['idEstado' => 'idEstado']);
    }

    /**
     * Gets query for [[IdSolicitante0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSolicitante0()
    {
        return $this->hasOne(Solicitante::className(), ['idSolicitante' => 'idSolicitante']);
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
}
