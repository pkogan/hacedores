<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registro".
 *
 * @property int $idHacedor
 * @property int|null $idUsuario
 * @property string|null $marca
 * @property string|null $mail
 * @property string|null $apellidoNombre
 * @property int|null $telefono
 * @property string|null $Localidad
 * @property int|null $impresores
 * @property string|null $modelos
 * @property string|null $tipoFilamento
 * @property string|null $stock
 * @property string|null $recursos
 * @property string|null $contacto
 * @property string|null $provincia
 * @property string|null $Comentario
 * @property string|null $impresoras
 * @property string|null $PLA
 * @property string|null $ABS
 * @property string|null $PETG
 * @property string|null $FLEX
 * @property string|null $HIPS
 * @property string|null $ciudad
 * @property int|null $idCiudad
 * @property string|null $direccion
 * @property string|null $token
 *
 * @property Ciudad $idCiudad0
 * @property Usuario $idUsuario0
 * @property Producto[] $productos
 */
class Registro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $idProvincia;
    //public $sumproductos;
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
            [['mail','apellidoNombre','telefono','impresores','idCiudad'],'required'],
            [['idUsuario', 'telefono', 'impresores', 'idCiudad','PLA','ABS', 'PETG', 'FLEX', 'HIPS'], 'integer'],
            [['marca'], 'string', 'max' => 19],
            [['mail'], 'string', 'max' => 35],
            [['mail'], 'unique'],
            [['apellidoNombre', 'token'], 'string', 'max' => 32],
            [['Localidad', 'provincia', 'ciudad'], 'string', 'max' => 23],
            [['modelos'], 'string', 'max' => 58],
            [['tipoFilamento'], 'string', 'max' => 63],
            [['stock'], 'string', 'max' => 67],
            [['recursos'], 'string', 'max' => 165],
            [['contacto',], 'string', 'max' => 2],
            [['Comentario'], 'string', 'max' => 347],
            [['impresoras'], 'string', 'max' => 1],
            [['direccion'], 'string', 'max' => 300],
            [['mail'], 'email'],
            [['idCiudad'], 'exist', 'skipOnError' => true, 'targetClass' => Ciudad::className(), 'targetAttribute' => ['idCiudad' => 'idCiudad']],
            [['idUsuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['idUsuario' => 'idUsuario']]
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
            'marca' => 'Marca',
            'mail' => 'Mail',
            'apellidoNombre' => 'Apellido Nombre',
            'telefono' => 'Telefono',
            'Localidad' => 'Localidad',
            'impresores' => 'Cantidad de Impresoras 3D',
            'modelos' => 'Modelos de Impresoras',
            'tipoFilamento' => 'Tipo Filamento',
            'stock' => 'Stock de Material',
            'recursos' => 'Cuenta con Recursos Humanos y Técnicos para operar las impresoras',
            'contacto' => 'Contacto',
            'provincia' => 'Provincia',
            'Comentario' => 'Comentario',
            'impresoras' => 'Impresoras',
            'PLA' => 'PLA',
            'ABS' => 'ABS',
            'PETG' => 'PETG',
            'FLEX' => 'FLEX',
            'HIPS' => 'HIPS',
            'ciudad' => 'Ciudad',
            'idCiudad' => 'Ciudad',
            'idProvincia' => 'Provincia',

            'direccion' => 'Dirección',
            'token' => 'Token',
        ];
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
     * Gets query for [[IdUsuario0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario0()
    {
        return $this->hasOne(Usuario::className(), ['idUsuario' => 'idUsuario']);
    }
    
    public function getIdProvincia()
    {
        return $this->idCiudad0->idProvincia;
    }
    
    /**
     */
    public function getProductos(){
        return $this->hasMany(Producto::className(), ['idHacedor' => 'idHacedor']);
    }
    
    public function getEntregas()
    {
        return $this->hasMany(Entrega::className(), ['idProducto' => 'idProducto'])
            ->via('productos');
    }
    
    public function getSumproductos()
    {
        return $this->getProductos()->sum('producto.cantidad');
    }
    
    public function getSumentregada()
    {
        return $this->getEntregas()->sum('entrega.cantidad');
    }
    
    public function getStock(){
        return $this->getSumproductos()-$this->getSumentregada();
    }
}
