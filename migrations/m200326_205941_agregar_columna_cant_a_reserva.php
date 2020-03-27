<?php

use yii\db\Migration;

/**
 * Class m200326_205941_agregar_columna_cant_a_reserva
 */
class m200326_205941_agregar_columna_cant_a_reserva extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'reserva',
            'cantidad', $this->integer());
	
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_205941_agregar_columna_cant_a_reserva cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_205941_agregar_columna_cant_a_reserva cannot be reverted.\n";

        return false;
    }
    */
}
