<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "institucion".
 *
 * @property int $idInstitucion
 * @property string|null $nombre
 * @property string|null $logo
 * @property int $idCiudad
 * @property string|null $direccion
 * @property string|null $tel
 *
 * @property Entrega[] $entregas
 * @property Ciudad $idCiudad0
 * @property Pedido[] $pedidos
 */
class Institucion extends \yii\db\ActiveRecord
{
    const OTROID=2;
    const CENTROENSAMLADOID=3;
    const CENTRODISTSALUDID=4;
    const NOMBRES=[2=>"OTRO",3=>"CENTRO DE ENSAMBLADO",4=>"CENTRO DE DISTRIBUCIÓN ZONAL SISTEMA DE SALUD"];
    public $idProvincia;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'institucion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCiudad','nombre', 'idProvincia'], 'required'],
            [['idCiudad'], 'integer'],
            [['nombre', 'logo', 'direccion', 'tel'], 'string', 'max' => 255],
            [['idCiudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idCiudad' => 'idCiudad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idInstitucion' => 'Institucion',
            'nombre' => 'Nombre',
            'logo' => 'Logo',
            'idCiudad' => 'Ciudad',
            'idProvincia' => 'Provincia',
            'direccion' => 'Direccion',
            'tel' => 'Tel',
        ];
    }

    /**
     * Gets query for [[Entregas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idInstitucion' => 'idInstitucion']);
    }

    /**
     * Gets query for [[IdCiudad0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCiudad0()
    {
        return $this->hasOne(Ciudad::className(), ['idCiudad' => 'idCiudad']);
    }

    /**
     * Gets query for [[Pedidos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['idInstitucion' => 'idInstitucion']);
    }
    
    public function getSumpedidos()
    {
        return $this->getPedidos()->sum('pedido.cantidad');
    }
    
    public function getSumentregada()
    {
        return $this->getEntregas()->sum('entrega.cantidad');
    }
}
