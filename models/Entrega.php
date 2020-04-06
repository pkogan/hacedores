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
 * @property string $receptor De la entrega
 * @property int $idEstado Estado de la entrego por defecto 0
 * @property int $idUsuarioValidador Usuario Validador de la entrega
 * @property EstadoEntrega $estado Estado de la entrego por defecto 0
 * @property Usuario $usuarioValidador Usuario Validador de la entrega
 * @property int $idCiudad
 * @property Ciudad $ciudad
 */
class Entrega extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $idProvincia;
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
            [['fecha', 'cantidad','idInstitucion','receptor','idCiudad'], 'required'],
            [['cantidad','idEstado','idCiudad','idUsuarioValidador'], 'integer'],
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
            'receptor '=> 'Receptor',
            'idEstado' => 'Estado',
            'idCiudad' =>'Ciudad',
            'idProvincia'=> 'Provincia',
            'idUsuarioValidador' => 'Id usuario validador',
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

    public function getEstado()
    {
        return $this->hasOne(EstadoEntrega::className(), ['idEstado' => 'idEstado']);
    }
    public function getUsuarioValidador()
    {
        return $this->hasOne(Usuario::className(), ['idUsuarioValidador' => 'idUsuario']);
    }
    public function getCiudad()
    {
        return $this->hasOne(Ciudad::className(), ['idCiudad' => 'idCiudad']);
    }
    
    }
