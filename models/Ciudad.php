<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudad".
 *
 * @property string|null $categoria
 * @property string|null $centroide_lat
 * @property string|null $centroide_lon
 * @property string|null $departamento_id
 * @property string|null $departamento_nombre
 * @property string|null $fuente
 * @property int $idCiudad
 * @property int|null $localidad_censal_id
 * @property string|null $localidad_censal_nombre
 * @property string|null $municipio_id
 * @property string|null $municipio_nombre
 * @property string|null $ciudad
 * @property int|null $idProvincia
 * @property string|null $provincia_nombre
 *
 * @property Provincia $idProvincia0
 * @property Usuario[] $usuarios
 */
class Ciudad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ciudad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCiudad'], 'required'],
            [['idCiudad', 'localidad_censal_id', 'idProvincia'], 'integer'],
            [['categoria', 'ciudad'], 'string', 'max' => 45],
            [['centroide_lat', 'centroide_lon'], 'string', 'max' => 17],
            [['departamento_id', 'fuente'], 'string', 'max' => 5],
            [['departamento_nombre'], 'string', 'max' => 34],
            [['localidad_censal_nombre'], 'string', 'max' => 80],
            [['municipio_id'], 'string', 'max' => 6],
            [['municipio_nombre'], 'string', 'max' => 38],
            [['provincia_nombre'], 'string', 'max' => 53],
            [['idCiudad'], 'unique'],
            [['idProvincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idProvincia' => 'idProvincia']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoria' => 'Categoria',
            'centroide_lat' => 'Centroide Lat',
            'centroide_lon' => 'Centroide Lon',
            'departamento_id' => 'Departamento ID',
            'departamento_nombre' => 'Departamento Nombre',
            'fuente' => 'Fuente',
            'idCiudad' => 'Id Ciudad',
            'localidad_censal_id' => 'Localidad Censal ID',
            'localidad_censal_nombre' => 'Localidad Censal Nombre',
            'municipio_id' => 'Municipio ID',
            'municipio_nombre' => 'Municipio Nombre',
            'ciudad' => 'Ciudad',
            'idProvincia' => 'Id Provincia',
            'provincia_nombre' => 'Provincia Nombre',
        ];
    }

    /**
     * Gets query for [[IdProvincia0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProvincia0()
    {
        return $this->hasOne(Provincia::className(), ['idProvincia' => 'idProvincia']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['idCiudad' => 'idCiudad']);
    }
}
