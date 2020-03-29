<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property int $idPedido
 * @property int $idInstitucion
 * @property int $idSolicitante
 * @property string $fecha
 * @property string|null $observacion
 * @property string|null $imagen
 * @property int $idModelo
 * @property int $cantidad
 * @property int $idEstado
 *
 * @property Institucion $idInstitucion0
 * @property Usuario $idSolicitante0
 * @property Modelo $idModelo0
 * @property Estado $idEstado0
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
            [['idInstitucion', 'idSolicitante', 'fecha', 'cantidad','idModelo', 'idEstado'], 'required'],
            [['idInstitucion', 'idSolicitante', 'idModelo', 'cantidad', 'idEstado'], 'integer'],
            [['fecha'], 'safe'],
            [['observacion'], 'string', 'max' => 300],
            [['imagen'], 'string', 'max' => 200],
            [['idInstitucion'], 'exist', 'skipOnError' => true, 'targetClass' => Institucion::className(), 'targetAttribute' => ['idInstitucion' => 'idInstitucion']],
            [['idSolicitante'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idSolicitante' => 'idUsuario']],
            [['idModelo'], 'exist', 'skipOnError' => true, 'targetClass' => Modelo::className(), 'targetAttribute' => ['idModelo' => 'idModelo']],
            [['idEstado'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idEstado' => 'idEstado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idPedido' => 'Id Pedido',
            'idInstitucion' => 'Institucion',
            'idSolicitante' => 'Solicitante',
            'fecha' => 'Fecha',
            'observacion' => 'Observacion',
            'imagen' => 'Imagen',
            'idModelo' => 'Modelo',
            'cantidad' => 'Cantidad',
            'idEstado' => 'Estado',
        ];
    }

    /**
     * Gets query for [[IdInstitucion0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdInstitucion0()
    {
        return $this->hasOne(Institucion::className(), ['idInstitucion' => 'idInstitucion']);
    }

    /**
     * Gets query for [[IdSolicitante0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdSolicitante0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idSolicitante']);
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
     * Gets query for [[IdEstado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado0()
    {
        return $this->hasOne(Estado::className(), ['idEstado' => 'idEstado']);
    }
}
