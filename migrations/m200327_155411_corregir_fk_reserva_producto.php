<?php

use yii\db\Migration;

/**
 * Class m200327_155411_corregir_fk_reserva_producto
 */
class m200327_155411_corregir_fk_reserva_producto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(){

        $this->dropForeignKey('fk-reserva-producto', 'reserva');
        $this->addForeignKey(
            'fk-reserva-producto',
            'reserva', 'idProducto',
            'producto', 'idProducto',
            'SET NULL', 'SET NULL');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200327_155411_corregir_fk_reserva_producto cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200327_155411_corregir_fk_reserva_producto cannot be reverted.\n";

        return false;
    }
    */
}
