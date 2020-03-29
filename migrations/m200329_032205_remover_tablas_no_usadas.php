<?php

use yii\db\Migration;

/**
 * Class m200329_032205_remover_tablas_no_usadas
 */
class m200329_032205_remover_tablas_no_usadas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('asignacion');
        
        $this->dropForeignKey('pedido_ibfk_1', 'pedido');
        // removemos el NOT NULL
        $this->alterColumn('pedido', 'idSolicitante',
                          $this->integer(11));

        $this->dropTable('solicitante');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200329_032205_remover_tablas_no_usadas cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200329_032205_remover_tablas_no_usadas cannot be reverted.\n";

        return false;
    }
    */
}
