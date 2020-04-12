<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

use app\models\Contacto;

/**
 */
class MailtestController extends Controller
{
    /**
     */
    public function actionIndex($contacto_id=1)
    {
        $contacto = Contacto::find($contacto_id)->one();
        if (array_key_exists('contacto', Yii::$app->params)){
            $to = Yii::$app->params['contacto']['lista_correo'];
        }else{
            $this->stdout("No hay seteado un correo en " .
                         "params['contacto']['lista_correo']\n",
                         Console::FG_RED);
            $to = 'no_seteado@test.org';
        }

        $mail = Yii::$app->mailer->compose('contacto',
                                        ['contacto' => $contacto])
                   ->setSubject('Contacto recibido')
                   ->setFrom('hornero@fi.uncoma.edu.ar')
                   ->setTo($to);

        echo $mail->toString();
        
        return ExitCode::OK;
    }
}
