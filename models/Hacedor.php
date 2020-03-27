<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hacedor".
 *
 * @property int $idHacedor
 * @property int $idUsuario
 * @property string $institucion
 * @property int $cantidadMaquinas
 * @property string $materialImprimir
 * @property string $link
 *
 * @property Asignacion[] $asignacions
 * @property Usuario $idUsuario0
 * @property Modelo[] $modelos
 */
class Hacedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hacedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idUsuario', 'institucion', 'cantidadMaquinas', 'materialImprimir', 'link'], 'required'],
            [['idUsuario', 'cantidadMaquinas'], 'integer'],
            [['institucion', 'materialImprimir', 'link'], 'string', 'max' => 300],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idHacedor' => 'Id Hacedor',
            'idUsuario' => 'Id Usuario',
            'institucion' => 'Institucion',
            'cantidadMaquinas' => 'Cantidad Maquinas',
            'materialImprimir' => 'Material Imprimir',
            'link' => 'Link',
        ];
    }

    /**
     * Gets query for [[Asignacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAsignacions()
    {
        return $this->hasMany(Asignacion::className(), ['idHacedor' => 'idHacedor']);
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
     * Gets query for [[Modelos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getModelos()
    {
        return $this->hasMany(Modelo::className(), ['idHacedor' => 'idHacedor']);
    }

    /**
       Buscar el hacedor correspondiente al usuario dado.
     */
    public function por_usuario($user_id){
        return Hacedor::find()
                 ->where(['idUsuario' => $user_id])
                 ->one();
    } // por_usuario

    /**
     */
    public function getProductos(){
        return $this->hasMany(Producto::className(), ['idHacedor' => 'idHacedor']);
    } // getProductos

   
    /**
     */
    public function getUsuario(){
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    } // getUsuario
    
    /**
     */
    public function getNombre(){
        return $this->usuario->nombreUsuario;
    } // getNombre

    
    
    /**
     */
    public function cant_productos(){
        $cant = 0;
        foreach ($this->productos as $prod){
            $cant += $prod->cantidad;
        }
        return $cant;
    } // cant_productos

    /**
     */
    public function cant_entregas(){
        $cant = 0;
        foreach ($this->productos as $prod){
            $cant += $prod->cant_entregas();
        }
        return $cant;
    } // cant_entregas
}
