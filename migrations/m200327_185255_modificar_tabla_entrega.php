<?php

use yii\db\Migration;

/**
 * Class m200327_185255_modificar_tabla_entrega
 */
class m200327_185255_modificar_tabla_entrega extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('entrega_ibfk_1', 'entrega');
        $this->dropColumn('entrega', 'idAsignacion');

        $this->addColumn(
        'entrega',
        'idProducto', $this->integer());
        $this->addColumn(
        'entrega',
        'idInstitucion', $this->integer(11));

        $this->renameColumn(
        'entrega',
        'cantidadEntregada', 'cantidad');
        $this->addCommentOnColumn(
        'entrega', 'cantidad',
        'Cantidad de productos entregados.');


        $this->addForeignKey(
        'fk-entrega-producto',
        'entrega', 'idProducto',
        'producto', 'idProducto',
        'SET NULL', 'CASCADE');

        $this->addForeignKey(
        'fk-entrega-institucion',
        'entrega', 'idInstitucion',
        'institucion', 'idInstitucion',
        'SET NULL', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200327_185255_modificar_tabla_entrega cannot be reverted.\n";

        return false;
    }

    /*
       // Use up()/down() to run migration code without a transaction.
       public function up()
       {

       }

       public function down()
       {
       echo "m200327_185255_modificar_tabla_entrega cannot be reverted.\n";

       return false;
       }
     */
}
