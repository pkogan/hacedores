<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "solicitante".
 *
 * @property int $idSolicitante
 * @property int $idUsuario
 * @property string $Intitucion
 *
 * @property Pedido[] $pedidos
 * @property Usuario $idUsuario0
 */
class Solicitante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'solicitante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'Intitucion'], 'required'],
            [['idUsuario'], 'integer'],
            [['Intitucion'], 'string', 'max' => 300],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idSolicitante' => 'Id Solicitante',
            'idUsuario' => 'Id Usuario',
            'Intitucion' => 'Intitucion',
        ];
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idSolicitante' => 'idSolicitante']);
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
}
