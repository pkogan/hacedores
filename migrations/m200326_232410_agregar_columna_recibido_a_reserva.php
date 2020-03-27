<?php

use yii\db\Migration;

/**
 * Class m200326_232410_agregar_columna_recibido_a_reserva
 */
class m200326_232410_agregar_columna_recibido_a_reserva extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'reserva',
            'recibido', $this->boolean()->defaultValue(false));
	
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_232410_agregar_columna_recibido_a_reserva cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_232410_agregar_columna_recibido_a_reserva cannot be reverted.\n";

        return false;
    }
    */
}
