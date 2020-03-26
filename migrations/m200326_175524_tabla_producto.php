<?php

use yii\db\Migration;

/**
 * Class m200326_175524_tabla_producto
 */
class m200326_175524_tabla_producto extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('producto', [
            'idProducto' => $this->primaryKey(),
            'idHacedor' => $this->integer(11)->notNull(),
            'idModelo' => $this->integer(11)->notNull(),
            'cantidad' => $this->integer()->defaultValue(1),
        ], 'ENGINE InnoDB');

        $this->addForeignKey(
            'fk-producto-hacedor',
            'producto', 'idHacedor',
            'hacedor', 'idHacedor');
        $this->addForeignKey(
            'fk-producto-modelo',
            'producto', 'idModelo',
            'modelo', 'idModelo');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200326_175524_tabla_producto cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200326_175524_tabla_producto cannot be reverted.\n";

        return false;
    }
    */
}
