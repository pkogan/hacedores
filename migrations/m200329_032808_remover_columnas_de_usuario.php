<?php

use yii\db\Migration;

/**
 * Class m200329_032808_remover_columnas_de_usuario
 */
class m200329_032808_remover_columnas_de_usuario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('usuario', 'mail');
        $this->dropColumn('usuario', 'telefono');
        $this->dropColumn('usuario', 'telegram');
        $this->dropForeignKey('usuario_ibfk_2', 'usuario');
        $this->dropColumn('usuario', 'idCiudad');
        $this->dropColumn('usuario', 'nombreApellido');
        $this->dropColumn('usuario', 'direccion');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200329_032808_remover_columnas_de_usuario cannot be reverted.\n";

        return false;
    }

    /*
       // Use up()/down() to run migration code without a transaction.
       public function up()
       {

       }

       public function down()
       {
       echo "m200329_032808_remover_columnas_de_usuario cannot be reverted.\n";

       return false;
       }
     */
}
