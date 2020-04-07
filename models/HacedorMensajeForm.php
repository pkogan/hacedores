<?php
namespace app\models;

use Yii;
use yii\base\Model;

class HacedorMensajeForm extends Model {

    public $nombre;
    public $from_mail;
    public $from_tel;
    public $to_idHacedor;

    public $subject;
    public $texto;
    
    public $captcha;

    /**
     */
    public function rules(){
        return [
            [['from_mail', 'from_tel', 'captcha',
              'to_idHacedor', 'subject', 'nombre'], 'required'],
            [['captcha'], 'captcha'],
            [['texto', 'subject', 'from_tel', 'nombre'], 'string'],
            [['from_mail'], 'email'],
            [['to_idHacedor'], 'integer'],
        ];
    } // rules

    /**
     */
    public function attributeLabels(){
        return [
            'nombre' => 'Su nombre y apellido',
            'subject' => 'Asunto',
            'texto' => 'Texto',
            'captcha' => 'Captcha',
            'from_mail' => 'Su correo',
            'from_tel' => 'Su teléfono',
        ];
    } // attributeLabels


    /**
     */
    public function enviar_correo(){
        Yii::$app->mailer->compose('hacedor-contacto',
                                ['mensaje' => $this])
           ->setFrom('hacedores@fi.uncoma.edu.ar')
           ->setTo($this->hacedor->mail)
           ->send();
    } // enviar_correo
}
?>
