<?php

use yii\db\Migration;

/**
 * Class m200326_203857_tabla_reserva
 */
class m200326_203857_tabla_reserva extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reserva', [
            'idReserva' => $this->primaryKey(),
            'idProducto' => $this->integer(11),
            'idUsuario' => $this->integer(11)
        ], 'ENGINE InnoDB');

        $this->addForeignKey(
            'fk-reserva-producto',
            'reserva', 'idProducto',
            'producto', 'idProducto');

        $this->addForeignKey(
            'fk-reserva-gestor',
            'reserva', 'idUsuario',
            'usuario', 'idUsuario');        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_203857_tabla_reserva cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_203857_tabla_reserva cannot be reverted.\n";

        return false;
    }
    */
}
